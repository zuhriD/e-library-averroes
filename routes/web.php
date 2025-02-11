<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auths.login');
})->name('login')->middleware('guest');
Route::get('/register', function () {
    return view('auths.register');
})->name('register')->middleware('guest');

Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.daftar');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.masuk');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.keluar');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::resource('users', UserController::class);
});
