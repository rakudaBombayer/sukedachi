@extends('layouts.app')

@section('content')

<div class="min-h-screen flex  justify-center pt-12 bg-white">
    <div class="w-full max-w-2xl mx-auto p-2">

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

        <div class="flex flex-col gap-2 items-center">
            <label for="title" style="font-weight: bold; color: black;" class="flex flex-col gap-2 items-center">タイトル</label>
            <input type="text" id="title" name="title" class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" value="{{ old('title', $request->title) }}" required>
        </div>

        {{-- お手伝いカテゴリのプルダウン --}}
        <div class="flex flex-col gap-2 items-center pt-2">
            <label for="help_category_ID" style="font-weight: bold; color: black;">お手伝い種類</label>
            <select id="help_category_ID" class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2 text-center" name="help_category_ID" required>
                <option value="1">送迎</option>
                <option value="2">手伝い</option>
                <option value="3">買い物</option>
                <option value="4">その他</option>
            </select>
            @error('help_category_ID')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col gap-2 items-center pt-2">
            <label for="help_details" style="font-weight: bold; color: black;">お手伝い詳細</label>
            <textarea
                id="help_details"
                name="help_details"
                rows="4"
                required
                class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[40px] px-4 py-2 resize-none">{{ old('help_details', $request->help_details) }}</textarea>
        </div>

        {{-- 希望日、希望時間 --}}
        <div class="flex flex-col gap-2 items-center pt-2">
            <label for="requested_date" style="font-weight: bold; color: black;">希望日、希望時間</label>
            <input type="datetime-local" id="requested_date" name="requested_date" class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" value="{{ old('requested_date', \Carbon\Carbon::parse($request->requested_date)->format('Y-m-d\TH:i')) }}" required>
        </div>

        {{-- 画像 --}}
        <div class="flex flex-col gap-2 items-center pt-2">
          
            @if ($request->image && $request->image->image)
                <img src="{{ asset($request->image->image) }}" alt="Current Image" style="max-width: 200px; max-height: 200px;">
                <br>
            @endif
              <label for="image" class="inline-block w-3/4 bg-[#FF9D9D] text-white font-bold text-center mt-3 px-4 py-2 rounded-[60px] cursor-pointer hover:bg-[#fd8f8f] ">お手伝い画像 (現在の画像: {{ $request->image ? 'あり' : 'なし' }})</label>
            <input type="file" id="image" name="image" accept="image/*" class="hidden pt-2">
            <small>JPEG、PNG、GIF形式のファイルを選択してください。新しい画像を選択すると、古い画像は置き換えられます。</small>
        </div>

        {{-- 所要時間 --}}
        <div class="flex flex-col gap-2 items-center pt-2">
            <label for="estimated_time" style="font-weight: bold; color: black;">所要時間</label>
            <input type="text" id="estimated_time" name="estimated_time" class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[20px] px-4 py-2"  value="{{ old('estimated_time', $request->estimated_time) }}" required>
        </div>

        {{-- 大まかな場所 --}}
        <div class="flex flex-col gap-2 items-center pt-2">
            <label for="location" style="font-weight: bold; color: black;">大まかな場所</label>
            <input type="text" id="location" name="general_area" class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[20px] px-4 py-2" value="{{ old('general_area', $request->general_area) }}" required>
        </div>
        
        <input type="hidden" name="user_ID" value="{{ $request->user_ID }}">
        <div class="flex">
            <button type="submit" class="w-3/4 mx-auto bg-[#FF9D9D] border border-gray-300 rounded-[20px] items-center mt-3 px-4 py-2 text-white font-bold hover:bg-[#fd8f8f] transition">更新</button>
        </div>
    </form>

    <div style="margin-top: 20px;" class="w-3/4 mx-auto bg-white border border-[#FF9D9D] rounded-[20px] mt-3 px-4 py-2 text-[#FF9D9D] font-bold text-center">
        <a href="{{ route('requests.show', $request->request_ID) }}">依頼詳細に戻る</a>
    </div>

    </div>
</div>



{{-- 今日以前をカレンダーで選べなくした。 ↓--}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('requested_date');

        const now = new Date();
        now.setSeconds(0, 0); // 秒以下は切り捨て（Chromeの入力精度と合わせるため）

        // 日時を "YYYY-MM-DDTHH:MM" に整形
        const formatted = now.toISOString().slice(0,16);
        input.min = formatted;
    });
</script>


@endsection


{{-- </body>
</html> --}}