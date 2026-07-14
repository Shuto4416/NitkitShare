@extends('layouts.app')
@section('title', 'フレンドリスト')
@section('content')

    
@foreach($friends as $friend)
@php
$partnerId = $friend->user_id == $userId ? $friend->fri_id: $friend->user_id;
@endphp
<form action="{{ route('friends.room') }}" method="GET">
    <div style="display: flex; justify-content: left; align-items: start; gap: 0 10px; position: relative;">
        <div style="position: relative; display: flex; justify-content: left; margin: 0 100px 0px 100px; padding: .8em 1em; width: 100%; height:auto; word-break:break-all; box-sizing:border-box;">
            <div style="position: relative; overflow: hidden; border-radius: 50%; max-width: 70px; max-height: 70px; border: 3px solid #f2f2f2;">
                ★ここにアイコン画像を指定★
            </div>
            <div>
                <div style="margin: 0 0 0 20px;">
                    <font size=4>
                        {{ $partnerId }}
                    </font>
                </div>
                <div style="color:darkgray">　
                    {{ $friend->msg->msg??'null'}}
                </div>
            </div>
            @csrf
            <input name="user_id" type="hidden" value="{{ $userId }}">
            <input name="fri_id" type="hidden" value="{{ $partnerId }}">
            <button type="submit" style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: transparent; border: none;
    cursor: pointer; outline: none; padding: 0; appearance: none;"></button>
        </div>
    </div>
</form>

@endforeach
@endsection
