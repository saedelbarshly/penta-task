<?php

use App\Models\Image;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\TwitterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $data = Image::orderByDesc('id')->get();
    return view('dashboard', compact('data'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('tweets',[TwitterController::class,'fetchTweets']);

Route::controller(FirebaseController::class)->group(function(){
    Route::get('verify-phone', 'verifyPhone')->name('verify-phone');
    Route::get('verify-code', 'verifyCode')->name('verify-code');
});


Route::controller(ImageController::class)->group(function(){
    Route::post('/upload', 'upload')->name('upload-image');
    Route::post('/accept-image', 'accept');
    Route::post('/reject-image', 'reject');
    Route::get('/delete-image/{image}', 'delete')->name('delete-image');
});


require __DIR__.'/auth.php';
