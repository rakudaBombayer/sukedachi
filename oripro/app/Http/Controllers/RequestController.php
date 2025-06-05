<?php
namespace App\Http\Controllers;

use App\Models\Request as UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


    class RequestController extends Controller 
    { 
        public function index() 
        { 
            $requests = UserRequest::all();
            // $requests = UserRequest::paginate(10);

                // foreach (UserRequest::cursor() as $request) {
                //     $requests[] = $request;
                // }
            
            return view('requests/index',compact('requests')); 
        } 
        
        public function create() 
        { 
            return view('requests/create'); 
        }
            
        public function store(Request $request)
            {
                $requestData = $request->all();

                $data = [
                    'user_ID' => 1,
                    'help_category_ID' => 1,
                    'title' => $requestData['title'] ?? null,
                    'requested_date' => isset($requestData['requested_date']) ? date('Y-m-d', strtotime($requestData['requested_date'])) : null,
                    'estimated_time' => $requestData['estimated_time'] ?? null,
                    'general_area' => $requestData['general_area'] ?? null,
                ];

                $requestModel = UserRequest::create($data);

                 //画像の保存処理↓(あまり理解していないのでもう一度)
                try {
                if ($request->hasFile('image')) {
                    Log::info('Image file is present.');
                    $imageFile = $request->file('image');
                    $filename = time() . '.' . $imageFile->getClientOriginalExtension();
                    $destinationPath = storage_path('app/public/images');
                    $imageFile->move($destinationPath, $filename); // move() を使用
                    $imageUrl = Storage::url('images/' . $filename);
                    $imageModel = new \App\Models\Image(['image' => $imageUrl]);
                    $imageModel->save();
                    $imageModel->refresh();

                    $requestModel->image_ID = $imageModel->image_ID;
                    $requestModel->save();

                    Log::info('Saved image ID:', ['image_id' => $requestModel->image_ID]);
                } else {
                    Log::info('Image file is NOT present.');
                }
            } catch (\Exception $e) {
                Log::error('Image saving error:', ['message' => $e->getMessage()]);
            }

                return redirect()->route('requests.complete', ['request' => $requestModel]);
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
        public function complete(\App\Models\Request $request)
        {
        // 投稿完了画面のロジックを記述
            return view('requests.complete', ['request' => $request]);
        }
    }