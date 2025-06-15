{{-- @extends('layouts.app')

@section('content') --}}

    <!DOCTYPE html>
<html>
<head>
    <title>スケダチ</title>
</head>
    <body>

    <h1>スケダチ</h1>
    <div>ちゃっとるーむへようこそ</div>
    <p>デバッグ: chatRoomId = {{ $chatRoomId ?? '未設定' }}</p>

    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('chat_messages.store') }}">
        @csrf
        {{-- 固定の chat_room_ID を設定 --}}
        <input type="hidden" name="chat_room_ID" value="{{ $chatRoomId }}">
        <input type="hidden" name="user_ID" value="{{ Auth::id() }}">
        <div>
            <label for="text">チャットメッセージ</label>
            <textarea id="text" name="text" required style="width: 300px; height: 80px;"></textarea>
        </div>
        <button type="submit">送信</button>
    </form>

    {{-- <button><a href="{{ url()->previous() }}">戻る</a></button> --}}
    {{-- <button><a href="{{ route('requests.show', $previousRequestId) }}">依頼詳細へ戻る</a></button> --}}
    <p>デバッグ: previousRequestId = {{ $previousRequestId ?? '未設定' }}</p>

    @if(isset($previousRequestId))
    <button><a href="{{ route('requests.show', $previousRequestId) }}">依頼詳細へ戻る</a></button>
    @else
        <button disabled>依頼詳細へ戻る</button> {{-- エラー回避用の表示 --}}
    @endif


    <hr>

    <div>
        <h3>チャットログ</h3>
        <ul>
            @foreach ($chatMessages as $message)
                <li>{{ $message->text }} (投稿者ID: {{ $message->user_ID }})</li>
            @endforeach
        </ul>
    </div>
</body>

    {{-- ここに投稿されたメッセージを表示する処理を追加します --}}
{{-- @endsection --}}
