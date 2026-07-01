<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Friend;



class FriendController extends Controller
{
    protected $msgController;

    public function __construct(MsgController $msgController)
    {
        $this->msgController = $msgController;
    }

    public function index()
    {
        // $friends = Friend::All(); 
        $friends = Friend::latest()->get();
        return view('friends.index', compact('friends'));
    }

    public function store(Request $request)
    {
        //msgにメッセージを登録&id取得
        $lastInsertMsg = $this->msgController->store($request);
        $friend = new Friend();
        $friend->user_id = $request->user_id;
        $friend->msg_id = $lastInsertMsg->id;
        $friend->fri_id = $request->fri_id;
        $friend->save();

        return redirect()->route('friends.index');
    }
}
