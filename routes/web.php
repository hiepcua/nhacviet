<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin routes
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('dashboard', [MainController::class, 'index'])->name('dashboard');
    Route::get('login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('login', [LoginController::class, 'handleLogin']);
    Route::get('register', [LoginController::class, 'register'])->name('register');
    Route::post('register', [LoginController::class, 'handleRegister']);
    Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('forgot-password', [LoginController::class, 'handleForgotPassword']);
});

