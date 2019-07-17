<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PublicChat;
use Illuminate\Support\Facades\Auth;
use App\{User, Country, Replay};


class ChatController extends Controller
{
    /**
     * Get 100 messages
     */
    public function get_messages() {
        $messages = PublicChat::select('user_id', 'user_name', 'message', 'file_path', 'imo', 'created_at')->with('user')
                ->orderBy('created_at', 'desc')
                ->limit(100)
                ->get();
        $result = array();
        foreach ($messages as $msg) {
            $result[] = $this->setFullMessage($msg);
        }

        return $result;
    }

    /**
     * Insert new messages from chat
     */
    public function insert_message(Request $request) {
       
        $message_data = $request->all();
        if (Auth::id() == $request->user_id) {
            $message_data['user_name'] = Auth::user()->name;
            $insert = PublicChat::create($message_data);           
            if($insert) {               
                return response()->json([
                    'status' => 'ok',
                    'id' => $insert->id, 'user' => Auth::id()
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 'fail'
            ], 200);
        }
      
            
    }

    /**
     * Get just updated message
     */
    public function get_message(Request $request) {
        $id = $request->id;
        $user_id = $request->user_id;
        $message = PublicChat::where('id', $id)->where('user_id', $user_id)->with('user')->first();
        return response()->json([
            'status' => "ok",
            'message' => $this->setFullMessage($message)
        ], 200);
      
    }

    public function setFullMessage($msg) {
        $countries = Country::all();
        $country_code = ($msg->user->country_id) ? mb_strtolower($countries[$msg->user->country_id]->code) : '';
        $race = ($msg->user->race) ? Replay::$race_icons[$msg->user->race] : Replay::$race_icons['All'];
        return  array(
            'user_id'=>$msg->user_id, 
            'user_name'=>$msg->user_name, 
            'message'=>$msg->message, 
            'file_path'=>$msg->file_path, 
            'imo'=>$msg->imo, 
            'created_at'=>$msg->created_at,
            'country_code'=>$country_code,
            'race'=>$race
        );
        return $msg;
    }
}
