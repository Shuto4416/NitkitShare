@extends('layouts.app')
@section('title', '{ページ名}')
@section('content')

<!-- 内容 -->
<h2>アカウント作成</h2>
    @if ($errors->any())
        <p style="color:red;"><?= htmlspecialchars($errors->first('msg')) ?></p>
    @endif
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div>名前: <input type="text" name="name" value="{{ old('name') }}" required></div>
        <div>メール: <input type="email" name="email" value="{{ old('email') }}" required placeholder="xxx@apps.kct.ac.jp"></div>
        <div>パスワード: <input type="password" name="password" required></div>
        <button type="submit">登録する</button>
    </form>
    <p><a href="{{ route('login.showLogin') }}">既にアカウントをお持ちの方はこちら</a></p>

@endsection