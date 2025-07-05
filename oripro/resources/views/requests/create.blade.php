@extends('layouts.app')

@section('content')


    <div>{{ Auth::id() }}</div>
    {{-- <form method="POST" action="{{ route('users.store') }}"> --}}
        <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col gap-2">
            <label for="title" style="font-weight: bold; color: black;">タイトル</label>
            <input type="text" id="title" name="title"  class="w-1/2 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" required>
        </div>
    
        {{-- <div>
            <label for="help_type">お手伝い種類</label>
            <input type="text" id="help_type" name="help_name" required>
        </div> --}}
        <div class="flex flex-col gap-2">
            <label for="help_type" style="font-weight: bold; color: black;">お手伝い種類</label>
            <select name="help_category_ID" class="w-1/2 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" required>
                <option value="1">送迎</option>
                <option value="2">手伝い</option>
                <option value="3">買い物</option>
                <option value="4">その他</option>
            </select>
        </div>
    
        <div class="flex flex-col gap-2">
            <label for="help_details" style="font-weight: bold; color: black;">お手伝い詳細</label>
            {{-- <input type="text" id="help_details" name="help_details" class="w-1/2 h-[15vh] bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" required > --}}
            <textarea
                id="location"
                name="general_area"
                required
                rows="4"
                class="w-1/2 bg-[#F2EEEE] border border-gray-300 rounded-[40px] px-4 py-2 resize-none"></textarea>
        </div>
    
        <div class="flex flex-col gap-2"> 
            <label for="requested_date" style="font-weight: bold; color: black;">希望日、希望時間</label>
            <input type="datetime-local"" id="requested_date" name="requested_date" class="w-1/2 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" required>
        </div>
    
        <div class="flex flex-col gap-2">
            {{-- ↓4枚にするかどうするか？ --}}
            <label for="image" style="font-weight: bold; color: black;">お手伝い画像</label>
            <input type="file" id="image" name="image">
            <small>JPEG、PNG、GIF形式のファイルを選択してください。</small>
        </div>
    
        <div class="flex flex-col gap-2">
            <label for="estimated_time" style="font-weight: bold; color: black;">所要時間</label>
            <input type="text" id="estimated_time" name="estimated_time" class="w-1/2 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" required>
        </div>
    
        <div class="flex flex-col gap-2">
            <label for="location" style="font-weight: bold; color: black;">大まかな場所</label>
            <input type="text" id="location" name="general_area" class="w-1/2 bg-[#F2EEEE] border border-gray-300 rounded-[20px] px-4 py-2" required>
        </div>
    
        <input type="hidden" name="user_ID" value="{{ Auth::id() }}">
        <button type="submit" style="font-weight: bold; color: black;">投稿</a></button>
    </form>
    <button><a href="{{ route('index') }}" style="font-weight: bold; color: black;">戻る</a></button>
{{-- </body> --}}



@endsection


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