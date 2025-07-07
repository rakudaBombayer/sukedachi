@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col">

    {{-- ヘッダー --}}
    {{-- <div class="bg-[#fd8f8f] text-white text-center py-4 text-lg font-semibold shadow">
        チャットルーム
    </div> --}}
    {{-- <p>デバッグ: chatRoomId = {{ $chatRoomId ?? '未設定' }}</p> --}}

     {{-- チャットログ --}}
    <div class="flex-1 overflow-y-auto px-4 py-2 flex flex-col-reverse gap-2">
        @foreach ($chatMessages->reverse() as $message)
            @if ($message->chat_room_ID == $chatRoomId)
                {{-- <div>{{ $message->text }} (投稿者ID: {{ $message->user_ID }})</div> --}}

            <div class="flex {{ $message->user_ID === Auth::id() ? 'justify-end' : 'justify-start' }}">
                <div class="{{ $message->user_ID === Auth::id() ? 'bg-[#FEE1E1]' : 'bg-[#F2EEEE]' }} max-w-[70%] px-4 py-2 rounded-2xl shadow text-sm font-bold">
                    {{ $message->text }}
                </div>
            </div>

            {{-- 相手のメッセージのときだけニックネームを表示 --}}
            @if ($message->user_ID !== Auth::id())
            <span style="line-height: 1; margin-bottom: 0px;" class="text-xs text-[#fd8f8f] font-semibold">
                {{ $message->user->nickname }}
            </span>
            @endif
            @endif
        @endforeach
    </div>

    <hr>

    {{-- メッセージ送信フォーム --}}
    <form method="POST" action="{{ route('chat_messages.store') }}" class="flex gap-2 p-4 bg-[#fef3f3]">
        @csrf
        {{-- 固定の chat_room_ID を設定 --}}
        <input type="hidden" name="chat_room_ID" value="{{ $chatRoomId }}">
        <input type="hidden" name="user_ID" value="{{ Auth::id() }}">
        <input type="text" name="text" required
           class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#fd8f8f]" />
        <button type="submit" class="bg-[#fd8f8f] text-white px-4 py-2 rounded-full font-bold hover:bg-[#f88] transition">
            送信
        </button>
    </form>
    {{-- <button><a href="{{ url()->previous() }}">戻る</a></button> --}}
    {{-- <button><a href="{{ route('requests.show', $previousRequestId) }}">依頼詳細へ戻る</a></button> --}}
    {{-- <p>デバッグ: previousRequestId = {{ $previousRequestId ?? '未設定' }}</p> --}}

    {{-- ↓⭐️previousReqestIDは必ずあるとともうので@if~@endifはなくていい気がしている --}}
    @if(isset($previousRequestId))
        {{-- <button><a href="{{ route('requests.show', $previousRequestId) }}">依頼詳細へ戻る</a></button> --}}
        <div class="justify-start bg-[#fef3f3]">
            <button onclick="window.location.href='{{ route('requests.show', $previousRequestId) }}'"
            class="inline-block bg-white text-[#fd8f8f] border-2 border-[#fd8f8f] mx-4 my-2 px-4 py-2 rounded-full font-bold hover:bg-[#FEE1E1] transition">
                戻る
            </button>
        </div>
    @else
        <button disabled>依頼詳細へ戻る</button> {{-- エラー回避用の表示 --}}
    @endif



</div>
@endsection
