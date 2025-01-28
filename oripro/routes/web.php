<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});// routes/web.php

// Userルート
Route::resource('users', UserController::class);

// ChatRoomルート
Route::resource('chat_rooms', ChatRoomController::class);

// ChatMessageルート（ネストされたリソースルート）
Route::resource('chat_rooms.messages', ChatMessageController::class);

// Requestルート
Route::resource('requests', RequestController::class);

// Applicantルート
Route::resource('applicants', ApplicantController::class);

// HelpCategoryルート
Route::resource('help_categories', HelpCategoryController::class);

// Imageルート
Route::resource('images', ImageController::class);

// Paymentルート
Route::resource('payments', PaymentController::class);