<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleHandlerController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\OneTimePasswordController;
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/google/auth', [GoogleHandlerController::class, 'store'])->name('googleHandle');

Route::middleware(['auth'])->group(function () {
    Route::get('/classes/index', [ClassesController::class, 'index'])->name('classesIndex');
    // Route::post('classes/store', [ClassesController::class, 'store'])->name('classesStore');
    // Route::post('classes/destroy', [ClassesController::class, 'destroy'])->name('classesDestroy');
    // Route::post('classes/update', [ClassesController::class, 'update'])->name('classesUpdate');

});