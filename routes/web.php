<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleHandlerController;
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/google/auth', [GoogleHandlerController::class, 'store'])->name('googleHandle');