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

Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');

Route::get('/requests/create', [RequestController::class, 'create'])->name('requests.create');


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



// ChatRoomルート

Route::resource('chat_rooms', ChatRoomController::class);



Route::post('/chat_rooms/goto/{request}', [ChatRoomController::class, 'gotoChat'])->name('chat_rooms.goto');



// ChatMessageルート（ネストされたリソースルート）

Route::resource('chat_rooms.messages', ChatMessageController::class);



Route::post('/chat-messages', [ChatMessageController::class, 'store'])->name('chat_messages.store');



// Requestルート

Route::resource('requests', RequestController::class);



Route::get('complete/{request}', [RequestController::class, 'complete'])->name('requests.complete');

Route::get('/requests/{request}/edit', [RequestController::class, 'edit'])->name('requests.edit');

// Route::put('/requests/{request}', [RequestController::class, 'update'])->name('requests.update');


Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');

// Route::put('/requests/{request}', [RequestController::class, 'update'])->name('requests.update');


// Applicantルート

Route::resource('applicants', ApplicantController::class);



// HelpCategoryルート

Route::resource('help_categories', HelpCategoryController::class);



// Imageルート

Route::resource('images', ImageController::class);


// ログアウト

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//投稿物の編集機能
Route::resource('posts', RequestController::class)->middleware(['auth']); // ログイン必須とする場合

require __DIR__.'/auth.php';