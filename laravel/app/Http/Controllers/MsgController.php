<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Msg;

class MsgController extends Controller
{
    // FriendControllerのstore関数から呼び出して、保存したメッセージのデータを渡す
    public function store(Request $request)
    {
        $imagePath = null;
        $msg = new Msg();
        $msg->msg = $request->msg;
        $msg->path = $imagePath;
        $msg->save();
        return $msg;
    }
}
