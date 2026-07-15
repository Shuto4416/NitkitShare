<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Friend;



class FriendController extends Controller
{
    // FriendControllerで使うmsgControllerを準備
    protected $msgController;

    // msgControllerを実体化
    public function __construct(MsgController $msgController)
    {
        $this->msgController = $msgController;
    }

    // ../friends/roomにアクセスしたときの挙動
    public function room(Request $request)
    {
        // requestのデータを受け取る
        $user_id = $request->user_id;
        $fri_id = $request->fri_id;

        // database/migrations/2026_06_23_050856_create_friends_tableで定義したFriendsTableのデータ全取得(最新順)

        // dbファイル作成のコマンド
        // {}はそこに文字を入れてほしいの意味。{}はコマンド実行時に消しておくこと
        // php artisan make:migration create_{テーブル名(英単語の複数形)}_table --create={テーブル名(英単語の複数形)}
        $friends = Friend::latest()->get();
        // データを投げてページを表示
        return view('friends.index', compact('friends','user_id','fri_id'));
    }

    public function index()
    {
        // ../friendsにアクセスしたときの処理
        $userId = 1;

        // ユーザーと会話履歴のあるユーザーを探索し、idに入れる
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
            // idを元にそれぞれのフレンドとの最新の会話データを取得
            $friends = Friend::with('msg')
                        ->whereIn('id', $ids)
                        ->orderByDesc('id')
                        ->get();
            // データを受け渡してページを表示
        return view('friends.list', compact('friends','userId'));
    }

    public function store(Request $request)
    {
        //msgにメッセージを登録&id取得
        $lastInsertMsg = $this->msgController->store($request);
        //FriendsTableにデータを保存
        $friend = new Friend();
        $friend->user_id = $request->user_id;
        $friend->msg_id = $lastInsertMsg->id;
        $friend->fri_id = $request->fri_id;
        $friend->save();
        // requestでデータを渡す代わりに[]の部分でデータを入れて渡す
        return redirect()->route('friends.room',['user_id' => $request->user_id, 'fri_id' => $request->fri_id]);
    }
}
