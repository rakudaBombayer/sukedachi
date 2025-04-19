<!DOCTYPE html>
<html>
<head>
    <title>ホーム</title>
</head>
<body>
    <h1></h1>
    <p>これは閲覧画面画面</p>
    <nav>
        <ul>
            <li><a href="{{ route('requests.create') }}" style="color: red;">手伝って</a></li>
            <li><a href="{{ route('requests.index') }}">ニックネーム</a></li>
            <li><a href="{{ route('requests.index') }}">リクエスト一覧</a></li>
            <li><a href="{{ route('applicants.index') }}">応募者一覧</a></li>
            <li><a href="{{ route('applicants.index') }}">応募者一覧</a></li>
            <li><a href="{{ route('applicants.index') }}">応募者一覧</a></li>
            <li><a href="{{ route('images.index') }}">画像一覧</a></li>
            <li><a href="{{ route('chat_rooms.index') }}" style="color: red;">手伝う</a></li>
        </ul>
    </nav>
</body>
</html>
