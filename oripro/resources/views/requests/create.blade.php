@extends('layouts.app')

@section('content')
    <h1>依頼投稿画面</h1>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div>
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" required>
        </div>
    
        <div>
            <label for="help_type">お手伝い種類</label>
            <input type="text" id="help_type" name="help_type" required>
        </div>
    
        <div>
            <label for="help_details">お手伝い詳細</label>
            <input type="text" id="help_details" name="help_details" required style="width: 300px; height: 80px;">
        </div>
    
        <div>
            <label for="preferred_datetime">希望日、希望時間</label>
            <input type="datetime-local"" id="preferred_datetime" name="preferred_datetime" required>
        </div>
    
        <div>
            <label for="image">お手伝い画像</label>
            <input type="file" id="image" name="image">
            <input type="file" id="image2" name="image">
            <input type="file" id="image3" name="image">
            <input type="file" id="image4" name="image">
            <small>JPEG、PNG、GIF形式のファイルを選択してください。</small>
        </div>
    
        <div>
            <label for="estimated_time">所要時間</label>
            <input type="text" id="estimated_time" name="estimated_time" required>
        </div>
    
        <div>
            <label for="location">大まかな場所</label>
            <input type="text" id="location" name="location" required>
        </div>
    
        <div>
            <label for="deadline">募集期限</label>
            <input type="datetime-local" id="deadline" name="deadline" required>
        </div>
    
        <button type="submit"><a href="{{ route('requests.complete') }}" style="color: red;">投稿</a></button>
    </form>
    <button styled=>戻る</button>
@endsection