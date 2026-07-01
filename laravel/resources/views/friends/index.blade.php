@extends('layouts.app')
@section('title', 'friends')
@section('content')
@php
$main_user_id = 1;
$friend_user_id = 2;
@endphp

@foreach($friends as $friend)
@if ($friend->user_id == $main_user_id)
<div style="display: flex; justify-content: left; align-items: start; gap: 0 10px; "> 
    <div style="position: absolute; overflow: hidden; border-radius: 50%; max-width: 70px; max-height: 70px; border: 3px solid #f2f2f2;">
        ★ここにアイコン画像を指定★
    </div> 
    <div style="position: relative; margin: 0 0px 30px 100px; padding: .8em 1em; border-radius: 5px; background-color: white; border: solid 2px #b0b0b0; max-width: 1100px; word-break:break-all;">
        <span style="position: absolute; left: -13px; width: 13px; height: 30px; color: #ffffff00; background-color: #b0b0b0; clip-path: polygon(0 50%, 100% 0, 100% 100%); top: 15px;">
            .
        </span>
        {{$friend->msg->msg??'null'}}
        <span style="position: absolute; left: -11px; width: 13px; height: 30px; color: #ffffff00; background-color: white; clip-path: polygon(0 50%, 100% 0, 100% 100%); top: 15px;">
            .
        </span>
    </div> 
</div>
@else
<div style="display: flex; justify-content: right; align-items: start; gap: 0 10px; position: relative;">
    <div style="position: absolute; right: 0; overflow: hidden; border-radius: 50%; max-width: 70px; max-height: 70px; border: 3px solid #f2f2f2;">
        ★ここにアイコン画像を指定★
    </div> 
    <div style="position: relative; margin: 0px 100px 30px 0px; padding: .8em 1em; border-radius: 5px; background-color: white; border: solid 2px #b0b0b0; max-width: 1100px; word-break:break-all;">
        <span style="position: absolute; right: -13px; width: 13px; height: 30px; color: #ffffff00; background-color: #b0b0b0; clip-path: polygon(0% 0%, 100% 50%, 0% 100%); top: 15px;">
            .
        </span>
        {{$friend->msg->msg??'null'}}
        <span style="position: absolute; right: -11px; width: 13px; height: 30px; color: #ffffff00; background-color: white; clip-path: polygon(0% 0%, 100% 50%, 0% 100%); top: 15px;">
            .
        </span>
    </div> 
</div>
@endif
@endforeach
<form action="{{ route('friends.store') }}" method="POST">
    <div style="width:100%; display:flex; align-items: flex-end; box-sizing:border-box">
        <div style="position: relative; margin: 0 0px 0px 100px; padding: .8em 1em; border-radius: 5px; background-color: white; border: solid 2px #b0b0b0; width: 80%; word-break:break-all;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $main_user_id }}">
            <input type="hidden" name="fri_id" value="{{ $friend_user_id }}">
            <textarea name="msg" placeholder="メッセージを入力してください" rows=3; style="box-sizing: border-box; width: 100%; height: 100%; resize: none; "></textarea>
        </div>
        <div>
            <input type="submit" value="->" style="border-radius: 5px; background-color: blue; border: solid 2px #b0b0b0; color: white;">
        </div>
</div>
</form>
@endsection
