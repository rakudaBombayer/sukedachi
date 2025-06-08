{{-- @extends('layouts.app')

@section('content') --}}

    <!DOCTYPE html>
<html>
<head>
    <title>スケダチ</title>
</head>
<body>
    <div>{{ Auth::id() }}</div>
    <h1>依頼投稿画面</h1>
    {{-- <form method="POST" action="{{ route('users.store') }}"> --}}
        <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" required>
        </div>
    
        {{-- <div>
            <label for="help_type">お手伝い種類</label>
            <input type="text" id="help_type" name="help_name" required>
        </div> --}}
        <div>
            <label for="help_type">お手伝い種類</label>
            <select name="help_category_ID">
                <option value="1">送迎</option>
                <option value="2">手伝い</option>
                <option value="3">買い物</option>
                <option value="4">その他</option>
            </select>
        </div>
    
        <div>
            <label for="help_details">お手伝い詳細</label>
            <input type="text" id="help_details" name="help_details" required style="width: 300px; height: 80px;">
        </div>
    
        <div>
            <label for="requested_date">希望日、希望時間</label>
            <input type="datetime-local"" id="requested_date" name="requested_date" required>
        </div>
    
        <div>
            <label for="image">お手伝い画像</label>
            <input type="file" id="image" name="image">
            {{-- <input type="file" id="image2" name="image">
            <input type="file" id="image3" name="image">
            <input type="file" id="image4" name="image"> --}}
            <small>JPEG、PNG、GIF形式のファイルを選択してください。</small>
        </div>
    
        <div>
            <label for="estimated_time">所要時間</label>
            <input type="text" id="estimated_time" name="estimated_time" required>
        </div>
    
        <div>
            <label for="location">大まかな場所</label>
            <input type="text" id="location" name="general_area" required>
        </div>
    
        <input type="hidden" name="user_ID" value="{{ Auth::id() }}">
        <button type="submit">投稿</a></button>
    </form>
    <button><a href="{{ route('index') }}">戻る</a></button>
</body>
{{-- @endsection --}}