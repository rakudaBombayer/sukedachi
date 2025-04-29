@extends('layouts.app')

@section('content')
    <h1>依頼投稿画面</h1>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <label for="name">タイトル</label>
        <input type="text" id="name" name="name" required>

        <label for="email">お手伝い種類</label>
        <input type="text" id="email" name="email" required>

        <label for="password">お手伝い詳細</label>
        <input type="text" id="password" name="password" required>

        <label for="name">希望日、希望時間</label>
        <input type="text" id="name" name="name" required>

        <label for="email">カメラ</label>
        <input type="text" id="email" name="email" required>

        <label for="text">所要時間</label>
        <input type="text" id="password" name="password" required>

        <label for="email">大まかな場所</label>
        <input type="email" id="email" name="email" required>

        <label for="password">募集期限</label>
        <input type="password" id="password" name="password" required>

    </form>
    <button styled=><a href="{{ route('requests.complete') }}" style="color: red;">投稿</a></button>
    <button styled=>戻る</button>
@endsection