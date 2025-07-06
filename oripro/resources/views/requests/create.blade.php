@extends('layouts.app')

@section('content')

<div class="min-h-screen flex  justify-center pt-12 bg-white">
    <div class="w-full max-w-2xl mx-auto p-2">
    {{-- <div>{{ Auth::id() }}</div> --}}
        <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-2 items-center">
                <label for="title" style="font-weight: bold; color: black;">タイトル</label>
                <input type="text" id="title" name="title"  class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" required>
            </div>
            <div class="flex flex-col gap-2 items-center pt-2">
                <label for="help_type" style="font-weight: bold; color: black;">お手伝い種類</label>
                <select name="help_category_ID" class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2 text-center" required>
                    <option value="1">送迎</option>
                    <option value="2">手伝い</option>
                    <option value="3">買い物</option>
                    <option value="4">その他</option>
                </select>
            </div>
            <div class="flex flex-col gap-2 items-center pt-2">
                <label for="help_details" style="font-weight: bold; color: black;">お手伝い詳細</label>
                <textarea
                    id="location"
                    name="general_area"
                    required
                    rows="4"
                    class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[40px] px-4 py-2 resize-none"></textarea>
            </div>
            <div class="flex flex-col gap-2 items-center pt-2"> 
                <label for="requested_date" style="font-weight: bold; color: black;">希望日、希望時間</label>
                <input type="datetime-local"" id="requested_date" name="requested_date" class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" required>
            </div>
        
            <div class="flex flex-col gap-2 items-center pt-2">
                {{-- ↓4枚にするかどうするか？ --}}
                {{-- <label for="image" style="font-weight: bold; color: black;">お手伝い画像</label>
                <input type="file" id="image" name="image"> --}}
                <!-- 選んだ画像を表示する領域 -->
                <img id="preview" class="mt-4 w-3/4 h-auto rounded-md hidden" />
                
                <label for="image" class="inline-block w-3/4 bg-[#FF9D9D] text-white font-bold text-center mt-3 px-4 py-2 rounded-[60px] cursor-pointer hover:bg-[#fd8f8f] ">
                画像を投稿
                </label>
                
                <input type="file" id="image" name="image" class="hidden pt-2" accept="image/*" />  
                {{-- <p id="file-info" class="mt-2 text-sm text-gray-600"></p> --}}
                {{-- <small>JPEG、PNG、GIF形式のファイルを選択してください。</small> --}}
            </div>
        
            <div class="flex flex-col gap-2 items-center pt-2">
                <label for="estimated_time" style="font-weight: bold; color: black;">所要時間</label>
                <input type="text" id="estimated_time" name="estimated_time" class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[60px] px-4 py-2" required>
            </div>
        
            <div class="flex flex-col gap-2 items-center pt-2">
                <label for="location" style="font-weight: bold; color: black;">大まかな場所</label>
                <input type="text" id="location" name="general_area" class="w-3/4 bg-[#F2EEEE] border border-gray-300 rounded-[20px] px-4 py-2" required>
            </div>
        
            <input type="hidden" class="mx-auto" name="user_ID" value="{{ Auth::id() }}">
            <div class="flex">
                <button type="submit" class="w-3/4 mx-auto bg-[#FF9D9D] border border-gray-300 rounded-[20px] items-center mt-3 px-4 py-2 text-white font-bold hover:bg-[#fd8f8f] transition" required>投稿</button>
            </div>
        </form>
        <div class="flex">
            <button onclick="window.location.href='{{ route('index') }}';" class="w-3/4 mx-auto bg-white border border-[#FF9D9D] rounded-[20px] mt-3 px-4 py-2 text-[#FF9D9D] font-bold">戻る</button>
        </div>
    </div>
</div>
    {{-- <a href="{{ route('index') }}" style="font-weight: bold; color: black;">戻る</a> --}}
{{-- </body> --}}






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


    //画像を投稿後見えるようにした。↓
   document.addEventListener('DOMContentLoaded', function () {
  const imageInput = document.getElementById('image');
  const preview = document.getElementById('preview');

  imageInput.addEventListener('change', function (e) {
    const file = e.target.files[0];

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();

      reader.onload = function (event) {
        preview.src = event.target.result;
        preview.classList.remove('hidden');
      };

      reader.readAsDataURL(file);
    } else {
      preview.src = '';
      preview.classList.add('hidden');
    }
  });
});
</script>

@endsection