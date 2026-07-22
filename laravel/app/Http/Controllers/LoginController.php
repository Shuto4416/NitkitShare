<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // 新規登録画面の表示
    public function showRegister()
    {
        return view('login.register');
    }

    // 新規登録処理
    public function register(Request $request)
    {
        $email = $request->input('email', '');
        
        // ドメイン制限チェック
        if (!str_ends_with($email, '@apps.kct.ac.jp')) {
            return back()->withErrors(['msg' => 'エラー: 指定されたドメインのメールアドレスのみ登録可能です。'])->withInput();
        }

        // データベースへ保存[cite: 6]
        Login::create([
            'name' => $request->input('name'),
            'email' => $email,
            'password' => Hash::make($request->input('password')),
            'create_date' => now(),
        ]);

        return redirect()->route('login.showLogin')->with('status', 'registered');
    }

    // ログイン画面の表示
    public function showLogin()
    {
        return view('login.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        $email = $request->input('email', '');
        $password = $request->input('password', '');

        // ドメイン制限チェック
        if (!str_ends_with($email, '@apps.kct.ac.jp')) {
            return back()->withErrors(['msg' => '指定ドメインのみログイン可能です。'])->withInput();
        }

        // ユーザーの取得[cite: 5]
        $user = Login::where('email', $email)->first();

        // 認証判定[cite: 5]
        if ($user && Hash::check($password, $user->password)) {
            session(['user_id' => $user->user_id]);
            return "ログイン成功！ようこそ " . htmlspecialchars($user->name) . " さん";
        }

        return back()->withErrors(['msg' => 'メールアドレスまたはパスワードが違います。'])->withInput();
    }
}