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

Route::middleware(['auth'])->group(function(){
    Route::get('admin', [MainController::class, 'index'])->name('admin');
    Route::get('admin/dashboard', [MainController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('admin/login', [LoginController::class, 'handleLogin']);
    Route::get('admin/register', [LoginController::class, 'register'])->name('admin.register');
    Route::post('admin/register', [LoginController::class, 'handleRegister']);
    Route::get('admin/forgot-password', [LoginController::class, 'forgotPassword'])->name('admin.forgot-password');
    Route::post('admin/forgot-password', [LoginController::class, 'handleForgotPassword']);
});
