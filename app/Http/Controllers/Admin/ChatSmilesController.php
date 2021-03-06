<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\{ SmileStoreRequest, SmileUpdateRequest};
use App\Services\Base\{BaseDataService, AdminViewService};
use App\Services\Chat\ChatSmileService;
use App\Http\Controllers\Controller;
use App\ChatSmile;

class ChatSmilesController extends Controller
{
     /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.chat.smiles.list')->with(['smiles_count'=> ChatSmile::count(), 'request_data' => []]);
    }

    /**
     * Get chat pictures list paginate
     *
     * @return array
     */
    public function pagination()
    {
        $smiles = ChatSmile::with('file', 'user')->orderBy('updated_at', 'Desc')->paginate(20);
        return BaseDataService::getPaginationData(
            AdminViewService::getChatSmiles($smiles), 
            AdminViewService::getPagination($smiles),
            AdminViewService::getChatSmilesPopUp($smiles)
        );
    
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $charactor_arr = array();  
        $smiles = ChatSmile::all();
        foreach ($smiles as $smile) {
            $charactor_arr[] = $smile->charactor;
        }
        $gen   = $this->get_charactor($charactor_arr);
        return view('admin.chat.smiles.create')->with(['charactor'=>$gen]);
    }

    /**
     * :smile:
     */
    private function get_charactor($charactor_arr){
        $check = true;
        $gen = "";
        while($check){
            $gen   = ':smile'. rand(1, 99) .':';
            if (!in_array($gen, $charactor_arr)) {
                $check = false;
            }
        }
        return $gen;
    }
    private function check_charactor($gen, $charactor_arr) 
    {        
        if (in_array($gen, $charactor_arr)) {
            return true;
        }
        return false;
    }

    /**
     * @param SmileStoreRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(SmileStoreRequest $request)
    {   
        $save = ChatSmileService::store($request);
        return redirect()->route('admin.chat.smiles');
    }

     /**
     * @param $smile_id
     * @return mixed
     */
    private function getSmileObject($smile_id)
    {
        return ChatSmile::getsmileById($smile_id);
    }


    
    /**
     * @param $smile_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($smile_id)
    {
        return view('admin.chat.smiles.edit')->with(['smile'=> $this->getSmileObject($smile_id)]);
    }

    /**
     * @param SmileUpdateRequest $request
     * @param $smile_id
     * @return \Illuminate\Http\SmileUpdateRequest
     */
    public function update(SmileUpdateRequest $request, $smile_id)
    {
        $smile = ChatSmile::find($smile_id);

        if($smile){
            ChatSmileService::update($request, $smile);
            return back();
        }
        return abort(404);
    }
    
    /**
     * @param $smile_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($smile_id)
    {
        ChatSmileService::destroy(ChatSmile::find($smile_id));
        return back();       
    }
}
