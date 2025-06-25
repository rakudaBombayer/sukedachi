<h1>選定ページ</h1>
<p>依頼ID: {{ $userRequest->request_ID }}</p>

<!-- ここに選定機能を追加していく -->

<h3>応募してくれたユーザー</h3>
<ul>
    @forelse ($userRequest->applicants as $applicant)
        <li>{{ $applicant->user->nickname }}（ユーザーID: {{ $applicant->user->user_ID }}）</li>
    @empty
        <li>まだ応募者がいません</li>
    @endforelse
</ul>