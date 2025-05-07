@extends('layouts.app')

@section('content')
    <h1>スケダチ</h1>
    <div>ちゃっとるーむへようこそ</div>

    <form method="POST" action="{{ route('chat_messages.store') }}">
        @csrf
        {{-- 固定の chat_room_ID を設定 --}}
        <input type="hidden" name="chat_room_ID" value="1"> {{-- 仮のID: 1 --}}
        <input type="hidden" name="user_ID" value="{{ Auth::id() }}">
        <div>
            <label for="text">チャットメッセージ</label>
            <textarea id="text" name="text" required style="width: 300px; height: 80px;"></textarea>
        </div>
        <button type="submit">送信</button>
    </form>

    <button><a href="{{ url()->previous() }}">戻る</a></button>

    <hr>

    <div>
        <h3>チャットログ</h3>
        <ul>
            @foreach ($chatMessages as $message)
                <li>{{ $message->text }} (投稿者ID: {{ $message->user_ID }})</li>
            @endforeach
        </ul>
    </div>

    {{-- ここに投稿されたメッセージを表示する処理を追加します --}}
@endsection
