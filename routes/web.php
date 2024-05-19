<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleHandlerController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\OneTimePasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentsController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/google/auth', [GoogleHandlerController::class, 'store'])->name('googleHandle');
Route::get('onetimepassword/{email}', [OneTimePasswordController::class, 'index'])->name('otpIndex');
Route::post('users/register', [UserController::class, 'register'])->name('usersRegister');

Route::middleware(['throttle:5,1'])->group(function () {
    Route::post('onetimepassword/verify', [OneTimePasswordController::class, 'verify'])->name('OtpVerify');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/classes/index', [ClassesController::class, 'index'])->name('classesIndex');
    Route::post('classes/store', [ClassesController::class, 'store'])->name('classesStore');
    Route::post('classes/destroy', [ClassesController::class, 'destroy'])->name('classesDestroy');
    Route::post('classes/update', [ClassesController::class, 'update'])->name('classesUpdate');
    Route::get('/classes/myclass', [ClassesController::class, 'myClass'])->name('myClass');

    Route::get('/students/index', [StudentsController::class, 'index'])->name('studentsIndex');
    Route::post('/students/class', [StudentsController::class, 'update'])->name('studentsClass');
});

Route::get('/temp', function () {
    return view('templates.components-modal');
});