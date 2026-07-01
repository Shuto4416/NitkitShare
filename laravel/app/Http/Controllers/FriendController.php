<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Friend;

class FriendController extends Controller
{
    public function index()
    {
        // $friends = Friend::All(); 
        $friends = Friend::latest()->get();
        return view('friends.index', compact('friends'));
    }
}
