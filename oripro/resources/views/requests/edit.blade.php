<!DOCTYPE html>
<html>
<head>
    <title>依頼編集</title>
</head>
<body>

    <h1>依頼編集画面</h1>

    {{-- エラーメッセージの表示 --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('requests.update', $request->request_ID) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- 更新にはPUT/PATCHメソッドを偽装する必要があります --}}

        <div>
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" value="{{ old('title', $request->title) }}" required>
        </div>

        {{-- お手伝いカテゴリのプルダウン --}}
        <div>
            <label for="help_category_ID">お手伝い種類</label>
            <select id="help_category_ID" name="help_category_ID" required>
                <option value="">カテゴリを選択してください</option>
                {{-- $helpCategories がコントローラーから渡されている必要があります --}}
                {{-- RequestController@edit メソッドにも helpCategories を渡すように修正が必要になる可能性があります --}}
                @foreach($helpCategories as $category)
                    <option value="{{ $category->help_category_ID }}"
                        {{ (old('help_category_ID', $request->help_category_ID) == $category->help_category_ID) ? 'selected' : '' }}>
                        {{ $category->help_name }}
                    </option>
                @endforeach
            </select>
            @error('help_category_ID')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 希望日、希望時間 --}}
        <div>
            <label for="requested_date">希望日、希望時間</label>
            <input type="datetime-local" id="requested_date" name="requested_date" value="{{ old('requested_date', \Carbon\Carbon::parse($request->requested_date)->format('Y-m-d\TH:i')) }}" required>
        </div>

        {{-- 画像 --}}
        <div>
            <label for="image">お手伝い画像 (現在の画像: {{ $request->image ? 'あり' : 'なし' }})</label>
            @if ($request->image && $request->image->image)
                <img src="{{ asset($request->image->image) }}" alt="Current Image" style="max-width: 200px; max-height: 200px;">
                <br>
            @endif
            <input type="file" id="image" name="image" accept="image/*">
            <small>JPEG、PNG、GIF形式のファイルを選択してください。新しい画像を選択すると、古い画像は置き換えられます。</small>
        </div>

        {{-- 所要時間 --}}
        <div>
            <label for="estimated_time">所要時間</label>
            <input type="text" id="estimated_time" name="estimated_time" value="{{ old('estimated_time', $request->estimated_time) }}" required>
        </div>

        {{-- 大まかな場所 --}}
        <div>
            <label for="location">大まかな場所</label>
            <input type="text" id="location" name="general_area" value="{{ old('general_area', $request->general_area) }}" required>
        </div>
        
        <input type="hidden" name="user_ID" value="{{ $request->user_ID }}">

        <button type="submit">更新</button>
    </form>

    <div style="margin-top: 20px;">
        <a href="{{ route('requests.show', $request->request_ID) }}">依頼詳細に戻る</a>
    </div>

</body>
</html>