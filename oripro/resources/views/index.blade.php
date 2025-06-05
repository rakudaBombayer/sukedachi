{{-- @extends('layouts.app')

@section('content') --}}

<!DOCTYPE html>
<html>
<head>
    <title>スケダチ</title>
</head>
<body>

    <h1></h1>
    <p>これは閲覧画面画面</p>
    <nav>
        <ul>
            <li><a href="{{ route('requests.create') }}" style="color: red;">手伝って</a></li>
            {{-- <li><a href="{{ route('requests.index') }}">ニックネーム</a></li>
            <li><a href="{{ route('requests.index') }}">リクエスト一覧</a></li>
            <li><a href="{{ route('applicants.index') }}">応募者一覧</a></li>
            <li><a href="{{ route('applicants.index') }}">応募者一覧</a></li>
            <li><a href="{{ route('applicants.index') }}">応募者一覧</a></li>
            <li><a href="{{ route('images.index') }}">画像一覧</a></li>
            <li><a href="{{ route('chat_rooms.index') }}" style="color: red;">手伝う</a></li> --}}

            @auth
                <p>ようこそ、{{ Auth::user()->name }} さん！</p>
                    <a href="{{ route('logout') }}">ログアウト</a>
            @else
                <p>ログインしていません。</p>
                <a href="{{ route('login') }}">ログイン</a>
            @endauth
        </ul>
    </nav>

    <div>
        <h2>投稿された依頼</h2>
        @if (isset($allRequests) && count($allRequests) > 0)
            <ul>
                @foreach ($allRequests as $request)
                    <li><a href="{{ route('requests.show', $request->request_ID) }}">{{ $request->title }}</a> - {{ $request->general_area }}</li>
                @endforeach
            </ul>
        @else
            <p>まだ投稿された依頼はありません。</p>
        @endif
    </div>
{{-- @endsection --}}