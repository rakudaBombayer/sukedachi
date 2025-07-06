@extends('layouts.app')

@section('content')

<p>依頼ID: {{ $userRequest->request_ID }}</p>
<h3>応募してくれたユーザー</h3>
<div class="min-h-screen flex  justify-center pt-12 bg-white">

    <!-- ここに選定機能を追加していく -->
    <div class="w-full">
    @forelse ($userRequest->applicants as $applicant)

    @php
        $chatRoom = \App\Models\ChatRoom::where('request_ID', $userRequest->request_ID)
                    ->where('user_ID', $applicant->user_ID)
                    ->first();
    @endphp

    <div class="flex justify-center my-2">
        @if ($chatRoom)
        <div class="w-2/3 bg-[#FEE1E1] border-2 border-[#f1f1f1] flex justify-between">
            {{-- ↓なくてもいいかも --}}
            {{-- <div class =" "> --}}
                {{-- ↑なくてもいいかも --}}
                <div class="font-bold">
                    {{ $applicant->user->nickname }}（ID: {{ $applicant->user_ID }}）
                </div>
                
                <div class="flex flex-col items-center gap-2">
                {{-- <a href="{{ route('chat_rooms.show', $chatRoom->chat_room_ID) }}">💬 チャットを見る</a> --}}
                    <button onclick="window.location.href='{{ route('chat_rooms.show', $chatRoom->chat_room_ID) }}'"
                    class="min-w-[150px]  bg-white hover:bg-[#fcd8d8] text-[#FF9D9D] font-semibold border-2 border-[#FF9D9D] mt-1  mr-1 py-2 px-4 rounded-3xl     transition duration-300">チャット</button>
                @else
                    {{-- <span style="color: gray;">チャット未作成</span> --}}
                @endif
                    <button class="min-w-[150px]  bg-[#FF9D9D]  text-white font-semibold border-2 border-[#FF9D9D] mb-1 mr-1 py-2 px-4 rounded-3xl">決定</button>
                </div>
            {{-- </div> --}}
        </div>
    </div>

    @empty
        <li>まだ応募者がいません</li>
    @endforelse
    </div>
</div>

<div>依頼内容↓</div>

@endsection
