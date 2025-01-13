<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;




Route::get('/{randomPath?}', function ($randomPath = null) {
    return view('welcome', ['randomPath' => $randomPath]);
})->name('welcome');

Route::get('/', function () {
    return view('welcome');
})->name('register.form');

Route::get('/user/{id}/decrypt-cookies', [AuthController::class, 'decryptCookies']);

// Handle registration submission
Route::post('/register', [AuthController::class, 'register'])->name('register');

