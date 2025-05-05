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
Route::get('/', function () {
    return view('index');
})->name('index');// routes/web.php

// ChatRoomルート
Route::resource('chat_rooms', ChatRoomController::class);

// ChatMessageルート（ネストされたリソースルート）
Route::resource('chat_rooms.messages', ChatMessageController::class);

// Requestルート
Route::resource('requests', RequestController::class);

Route::get('complete', [RequestController::class, 'complete'])->name('requests.complete');

Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');

// Applicantルート
Route::resource('applicants', ApplicantController::class);

// HelpCategoryルート
Route::resource('help_categories', HelpCategoryController::class);

// Imageルート
Route::resource('images', ImageController::class);

// Paymentルート
Route::resource('payments', PaymentController::class);