<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Msg;

class MsgController extends Controller
{
    //
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
