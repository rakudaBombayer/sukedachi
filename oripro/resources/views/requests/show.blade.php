{{-- @extends('layouts.app')

@section('content') --}}


    <!DOCTYPE html>
    <html>
        <head>
    <title>スケダチ</title>
        </head>
        <body>



    <h1>依頼詳細</h1>

    <form method="POST" action="{{ route('chat_rooms.goto', $request->request_ID) }}">
      @csrf
      <button type="submit">手伝う</button>
  </form>

    <div>
        <strong>タイトル:</strong> {{ $request->title }}
    </div>

    <div>
        <strong>お手伝い種類:</strong> {{ $request->help_name }}
    </div>

    <div>
        <strong>お手伝い詳細:</strong> <pre>{{ $request->help_details }}</pre>
    </div>

    <div>
        <strong>希望日時:</strong> {{ $request->requested_date }}
    </div>

        @if ($request->image)
            <div>
                <strong>画像:</strong>
                <img src="{{ asset($request->image->image) }}" alt="依頼画像" style="max-width: 300px;">
            </div>
        @endif

    <div>
        <strong>所要時間:</strong> {{ $request->estimated_time }}
    </div>

    <div>
        <strong>場所:</strong> {{ $request->general_area }}
    </div>

    <button><a href="{{ route('index') }}">ホームへ戻る</a></button>
{{-- @endsection --}}