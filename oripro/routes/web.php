<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\HelpCategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\YourHomeController;



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

Route::get('/complete/{request}', [RequestController::class, 'complete'])->name('requests.complete');

Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');

// Applicantルート
Route::resource('applicants', ApplicantController::class);

// HelpCategoryルート
Route::resource('help_categories', HelpCategoryController::class);

// Imageルート
Route::resource('images', ImageController::class);