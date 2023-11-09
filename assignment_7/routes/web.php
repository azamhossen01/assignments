<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::group(['middleware' => 'guest'], function(){
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'userLogin'])->name('user_login');
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.view');
    Route::post('/register', [RegisterController::class, 'userRegistration'])->name('register');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/edit_profile', [UserController::class, 'editProfile'])->name('edit_profile');
    Route::put('/update_profile', [UserController::class, 'updateProfile'])->name('update_profile');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/show/{uuid}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/edit/{uuid}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{uuid}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
});
