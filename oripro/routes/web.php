<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController; 


use App\Http\Controllers\UserController;

use App\Http\Controllers\ChatRoomController;

use App\Http\Controllers\ChatMessageController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\ApplicantController;

use App\Http\Controllers\HelpCategoryController;

use App\Http\Controllers\ImageController;


use App\Http\Controllers\YourHomeController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('index');
// });



Route::post('/requests', [RequestController::class, 'store'])->name('requests.store')
                    ->middleware('auth');
                    
Route::get('/requests/create', [RequestController::class, 'create'])
                    ->middleware('auth')
                    ->name('requests.create');
                    


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');
});



// Userルート

Route::resource('users', UserController::class);



//ホーム画面へ

Route::get('/', [YourHomeController::class, 'index'])->name('index');


//ChatRoom選定ページへ

// web.php
Route::get('/requests/{request}/selection', [RequestController::class, 'select'])->name('requests.select');


// ChatRoomルート

Route::resource('chat_rooms', ChatRoomController::class);







// ChatMessageルート（ネストされたリソースルート）

Route::resource('chat_rooms.messages', ChatMessageController::class);

// Route::post('/chat_rooms/goto/{request}', [ChatRoomController::class, 'goto'])->name('chat_rooms.goto');
// Route::get('/chat_rooms/goto/{request}', [ChatRoomController::class, 'goto'])->name('chat_rooms.goto');

// POST /chat_rooms/goto
// Route::post('/chat_rooms/goto', [ChatRoomController::class, 'gotoChat'])->name('chat_rooms.goto');

// Route::post('/chat_rooms/goto/{request}', [ChatRoomController::class, 'gotoChat'])->name('chat_rooms.goto');

Route::post('/chat_rooms/goto/{request}', [ChatRoomController::class, 'gotoChat'])->name('chat_rooms.goto.post');
Route::get('/chat_rooms/goto/{request}', [ChatRoomController::class, 'goto'])->name('chat_rooms.goto.get');



Route::post('/chat-messages', [ChatMessageController::class, 'store'])
                    ->middleware('auth') 
                    ->name('chat_messages.store');

Route::get('/chat_messages/{chatRoomId}', [ChatMessageController::class, 'index'])->name('chat_messages.index');


//重複しているかも↓
Route::get('/chat_rooms/{chatRoom}', [ChatRoomController::class, 'show'])->name('chat_rooms.show');
//重複しているかも↓
Route::post('/chat_rooms', [ChatRoomController::class, 'store'])->name('chat_rooms.store');


// Requestルート

Route::resource('requests', RequestController::class);



Route::get('complete/{request}', [RequestController::class, 'complete'])->name('requests.complete');

Route::get('/requests/{request}/edit', [RequestController::class, 'edit'])->name('requests.edit');

// Route::put('/requests/{request}', [RequestController::class, 'update'])->name('requests.update');


// Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');

// Route::put('/requests/{request}', [RequestController::class, 'update'])->name('requests.update');


// Applicantルート

Route::resource('applicants', ApplicantController::class);

// Route::post('/applicants', [ApplicantController::class, 'store'])->name('applicants.store');

Route::post('/chat_rooms/goto/{request}', [ChatRoomController::class, 'goto'])
    ->name('chat_rooms.goto');


// HelpCategoryルート

Route::resource('help_categories', HelpCategoryController::class);



// Imageルート

Route::resource('images', ImageController::class);


// ログアウト

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//投稿物の編集機能
Route::resource('posts', RequestController::class)->middleware(['auth']); // ログイン必須とする場合

require __DIR__.'/auth.php';