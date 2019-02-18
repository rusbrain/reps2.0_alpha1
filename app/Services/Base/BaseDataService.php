<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.02.19
 * Time: 11:34
 */

namespace App\Services\Base;


use App\ForumTopic;
use App\Http\Requests\QuickEmailRequest;
use App\Mail\QuickEmail;
use App\Replay;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class BaseDataService
{
    /**
     * @return array
     */
    public static function getAdminBaseData()
    {
        $topic_count = ForumTopic::where(function ($q){
            $q->whereNull('start_on')
                ->orWhere('start_on','<=', Carbon::now()->format('Y-M-d'));
        })->count();

        $gosu_replay_count = Replay::gosuReplay()->count();
        $user_replay_count = Replay::userReplay()->count();
        $user_count = User::count();

        return [
            'topic_count'       => $topic_count,
            'gosu_replay_count' => $gosu_replay_count,
            'user_replay_count' => $user_replay_count,
            'user_count'        => $user_count,
        ];
    }

    /**
     * @param QuickEmailRequest $request
     */
    public static function sendQuickEmail(QuickEmailRequest $request)
    {
        Mail::send(new QuickEmail($request->get('content'), $request->get('subject'), $request->get('emailto')));
    }

    /**
     * @param $table
     * @param $pagination
     * @param string $pop_up
     * @return array
     */
    public static function getPaginationData($table, $pagination, $pop_up = '')
    {
       return ['table' => $table, 'pagination' => $pagination, 'pop_up' => $pop_up];
    }
}