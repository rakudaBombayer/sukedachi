<?php
namespace App\Http\Controllers;

use App\Models\Request as UserRequest;
use Illuminate\Http\Request;

    class RequestController extends Controller 
    { 
        public function index() 
        { 
            $requests = UserRequest::all();
            
            return view('requests/index',
            
            compact('requests')); 
        } 
        
        public function create() 
        { 
            return view('requests/create'); 
        }
            
        public function store(Request $request) 
        { 
            $request->validate([ 'user_ID' => 'required|exists:users,user_ID', 'help_category_ID' => 'required|exists:help_categories,help_category_ID', ]); 
                
            UserRequest::create($request->all()); return redirect()->route('requests.index'); 
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