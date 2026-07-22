@extends('layouts.app')
@section('title', '{ページ名}')
@section('content')

<!-- 内容 -->
    @if(session('status') && session('status') == 'registered')
        <p style="color:green;">アカウント登録が完了しました。ログインしてください。</p>
    @endif

    <h2>ログイン</h2>
    @if ($errors->any())
        <p style="color:red;"><?= htmlspecialchars($errors->first('msg')) ?></p>
    @endif
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div>メール: <input type="email" name="email" value="{{ old('email') }}" required></div>
        <div>パスワード: <input type="password" name="password" required></div>
        <button type="submit">ログイン</button>
    </form>
    <p><a href="{{ route('register.post') }}">新規アカウント作成はこちら</a></p>


@endsection