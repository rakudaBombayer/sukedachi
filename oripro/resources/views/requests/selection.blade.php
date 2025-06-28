<h1>選定ページ</h1>
<p>依頼ID: {{ $userRequest->request_ID }}</p>

<!-- ここに選定機能を追加していく -->

<h3>応募してくれたユーザー</h3>
{{-- <ul>
    @forelse ($userRequest->applicants as $applicant)
        <li>{{ $applicant->user->nickname }}（ID: {{ $applicant->user_ID }}）</li>
    @empty
        <li>まだ応募者がいません</li>
    @endforelse

    
</ul> --}}

<ul>
@forelse ($userRequest->applicants as $applicant)

    @php
        $chatRoom = \App\Models\ChatRoom::where('request_ID', $userRequest->request_ID)
                    ->where('user_ID', $applicant->user_ID)
                    ->first();
    @endphp

    <li>
        {{ $applicant->user->nickname }}（ID: {{ $applicant->user_ID }}）

        @if ($chatRoom)
            <a href="{{ route('chat_rooms.show', $chatRoom->chat_room_ID) }}">💬 チャットを見る</a>
        @else
            <span style="color: gray;">チャット未作成</span>
        @endif
    </li>

@empty
    <li>まだ応募者がいません</li>
@endforelse
</ul>
