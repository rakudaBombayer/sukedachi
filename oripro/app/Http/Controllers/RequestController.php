<?php
namespace App\Http\Controllers;

use App\Models\Request as UserRequest;
use Illuminate\Http\Request;

    class RequestController extends Controller 
    { 
        public function index() 
        { 
            $requests = UserRequest::all();
            
            return view('requests/index',compact('requests')); 
        } 
        
        public function create() 
        { 
            return view('requests/create'); 
        }
            
        public function store(Request $request) 
        { 
            $requestData = $request->all();
            
            $data['user_ID'] = 1; // ← 一時的にユーザーIDをハードコード (例: 1)

            $data['help_category_ID'] = 1;

            $data['payment_method'] = '未設定'; // デフォルト値を設定

            if (isset($requestData['title'])) {
                $data['title'] = $requestData['title'];
            }
        
            if (isset($requestData['requested_date'])) {
                $data['requested_date'] = date('Y-m-d', strtotime($requestData['requested_date']));
            }
            if (isset($requestData['estimated_time'])) {
                $data['estimated_time'] = $requestData['estimated_time'];
            }
            if (isset($requestData['general_area'])) {
                $data['general_area'] = $requestData['general_area'];
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/images', $filename); // storage/app/public/images に保存
                $data['image_path'] = str_replace('public/', 'storage/', $path); // public ディレクトリからの相対パスを保存
            }
            
            // UserRequest::create($request->all()); return redirect()->route('requests.index'); 

            // データをデータベースに保存
            UserRequest::create($data);

            // 保存が完了したらリダイレクトなどの処理を行う
            return redirect()->route('requests.complete')->with('success', '依頼を投稿しました！');
        } 
                
        public function show(UserRequest $request) 
        {
            return view('requests.show', compact('request')); 
        } 
        
        public function edit(UserRequest $request) 
        { 
            return view('requests.edit', compact('request')); 
        } 
        
        public function update(Request $request, UserRequest $userequest)
        { 
            $request->validate([ 'user_ID' => 'required|exists:users,user_ID', 'help_category_ID' => 'required|exists:help_categories,help_category_ID', ]);
        
            $userequest->update($request->all()); return redirect()->route('requests.index'); 
        } 
        
        public function destroy(UserRequest $request) 
        {
            $request->delete(); return redirect()->route('requests.index'); 
        } 

            // ここに追加
        public function complete()
        {
        // 投稿完了画面のロジックを記述
            return view('requests.complete'); // 例：requests/complete.blade.php を表示
        }
    }