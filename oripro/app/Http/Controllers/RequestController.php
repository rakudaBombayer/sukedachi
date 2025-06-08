<?php
namespace App\Http\Controllers;

use App\Models\Request as UserRequest;

// use App\Models\HelpCategory; // createメソッドで必要
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth; // ★この行を追加！


    class RequestController extends Controller 
    { 

                // ★このコンストラクタを追加してください！
        public function __construct()
        {

            // parent::__construct(); // ★この行を追加！
            // $this->middleware('auth')->except(['index', 'show', 'create', 'complete']);

            // もし create もログイン必須にするなら以下のように書く
            // $this->middleware('auth')->except(['index', 'show', 'complete']);
            // あるいは、全てログイン必須なら
            // $this->middleware('auth');
        }

        
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
                    'user_ID' => Auth::id(), // ★修正：ログインユーザーのIDを自動でセット
                    // 'help_category_ID' => $request->help_category_ID,
                    'help_category_ID' => $requestData['help_category_ID'] ?? null,
                    'title' => $requestData['title'] ?? null,
                    'requested_date' => isset($requestData['requested_date']) ? date('Y-m-d', strtotime($requestData['requested_date'])) : null,
                    'estimated_time' => $requestData['estimated_time'] ?? null,
                    'general_area' => $requestData['general_area'] ?? null,
                ];

                // $requestModel = UserRequest::create($data);
                // dd($requestModel);


                
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
            // ★追加：投稿の所有者以外が編集できないようにする
            if (Auth::id() !== $request->user_ID) {
                abort(403, 'Unauthorized action.'); // 403 Forbidden エラーを返す
            }
            return view('requests.edit', compact('request')); 
        } 
        
        
        public function update(Request $request, UserRequest $useRequest)
        { 
            // ★追加：投稿の所有者以外が更新できないようにする
            if (Auth::id() !== $userRequest->user_ID) {
                abort(403, 'Unauthorized action.');
            }
            
            $request->validate([ 'user_ID' => 'required|exists:users,user_ID', 'help_category_ID' => 'required|exists:help_categories,help_category_ID', ]);

            $userRequest->update($request->except(['image'])); // 画像以外のデータを更新
            

            // 画像投稿編集機能↓
            try {
            if ($request->hasFile('image')) {
                // 古い画像がある場合は削除
                if ($userRequest->image && $userRequest->image->image) {
                    $oldFilename = basename($userRequest->image->image);
                    Storage::disk('public')->delete('images/' . $oldFilename);
                    $userRequest->image->delete(); // Imageモデルも削除
                }

                $imageFile = $request->file('image');
                $filename = time() . '.' . $imageFile->getClientOriginalExtension();
                $path = $imageFile->storePubliclyAs('images', $filename, 'public');
                $imageUrl = Storage::url($path);

                $imageModel = new \App\Models\Image(['image' => $imageUrl]);
                $imageModel->save();
                $imageModel->refresh();

                $userRequest->image_ID = $imageModel->image_ID;
                $userRequest->save();
            }
        } catch (\Exception $e) {
            Log::error('Image updating error:', ['message' => $e->getMessage()]);
        }

        // 画像投稿編集機能↑
        
        return redirect()->route('requests.show', $userRequest->id) // 修正: 更新後に詳細ページへ
                ->with('success', '投稿が更新されました。');
            
            //↓画像編集機能を試す前のリダイレクト先
            // $useRequest->update($request->all()); return redirect()->route('requests.index'); 
        } 
        
        
        public function destroy(UserRequest $request) 
        {   
            // ★追加：投稿の所有者以外が削除できないようにする
            if (Auth::id() !== $request->user_ID) {
            abort(403, 'Unauthorized action.');
        }

                // ★追加：関連する画像を先に削除(try)
        try {
            if ($request->image && $request->image->image) {
                $filename = basename($request->image->image);
                Storage::disk('public')->delete('images/' . $filename);
                $request->image->delete(); // Imageモデルも削除
            }
        } catch (\Exception $e) {
            Log::error('Image deletion error (during destroy):', ['message' => $e->getMessage()]);
        }
            //↑  ★追加：関連する画像を先に削除(try)  
        
            $request->delete(); 
            return redirect()->route('requests.index')
                            ->with('success', '投稿が削除されました。');
        } 

            // ここに追加
        public function complete(\App\Models\Request $request)
        {
        // 投稿完了画面のロジックを記述
            return view('requests.complete', ['request' => $request]);
        }
    }