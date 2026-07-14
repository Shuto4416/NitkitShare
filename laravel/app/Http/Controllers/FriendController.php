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

    public function room(Request $request)
    {
        $user_id = $request->user_id;
        $fri_id = $request->fri_id;

        $friends = Friend::latest()->get();
        return view('friends.index', compact('friends','user_id','fri_id'));
    }

    public function index()
    {
        $userId = 1;

        $ids = Friend::orderBy('id', 'desc')
            ->selectRaw("
                MAX(id) as id,
                CASE
                    WHEN fri_id = ? AND user_id = ? THEN CONCAT('self_', id)
                    WHEN fri_id = ? THEN user_id
                    ELSE fri_id
                END as partner
            ", [
                $userId,
                $userId,
                $userId,
            ])
            ->where(function ($q) use ($userId) {
                $q->where('fri_id', $userId)
                ->orWhere('user_id', $userId);
            })
            ->groupBy('partner')
            ->pluck('id');
            $friends = Friend::with('msg')
                        ->whereIn('id', $ids)
                        ->orderByDesc('id')
                        ->get();

        return view('friends.list', compact('friends','userId'));
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

        return redirect()->route('friends.room',['user_id' => $request->user_id, 'fri_id' => $request->fri_id]);
    }
}
