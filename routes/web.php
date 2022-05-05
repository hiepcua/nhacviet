<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;

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

Route::get('admin/users/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('admin/users/login', [LoginController::class, 'handleLogin'])->name('handleLogin');
Route::get('admin/users/register', [LoginController::class, 'register'])->name('register');
Route::get('admin/users/register', [LoginController::class, 'handleRegister']);
Route::get('admin/users/login/store', [LoginController::class, 'loginForm'])->name('admin.store');
Route::get('admin/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
Route::post('admin/forgot-password', [LoginController::class, 'handleForgotPassword']);

Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('admin', [MainController::class, 'index'])->name('admin');
        Route::get('admin/main', [MainController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function(){
            Route::get('/', [MenuController::class, 'index']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('edit/{id}', [MenuController::class, 'show']);
            Route::post('edit/{id}', [MenuController::class, 'update']);
            Route::delete('destroy', [MenuController::class, 'destroy']);
        });
    });
});

//     Route::get('admin', [MainController::class, 'index'])->name('admin');
//     Route::get('admin/dashboard', [MainController::class, 'index'])->name('admin.dashboard');
//     Route::get('admin/login', [LoginController::class, 'loginForm'])->name('admin.login');
//     Route::post('admin/login', [LoginController::class, 'handleLogin']);
//     Route::get('admin/register', [LoginController::class, 'register'])->name('admin.register');
//     Route::post('admin/register', [LoginController::class, 'handleRegister']);
//     Route::get('admin/forgot-password', [LoginController::class, 'forgotPassword'])->name('admin.forgot-password');
//     Route::post('admin/forgot-password', [LoginController::class, 'handleForgotPassword']);

