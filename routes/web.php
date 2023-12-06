<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show']);

Route::get('follow/{id}', [App\Http\Controllers\UserController::class, 'follow']);
Route::get('unfollow/{id}', [App\Http\Controllers\UserController::class, 'unfollow']);

Route::get('/like/{id}', [App\Http\Controllers\PostController::class, 'like']);
Route::get('/deslike/{id}', [App\Http\Controllers\PostController::class, 'deslike']);

Route::post('/post', [App\Http\Controllers\PostController::class, 'create']);
Route::get('/post/{id}/destroy', [App\Http\Controllers\PostController::class, 'destroy']);
Route::get('/post/{id}/edit', [App\Http\Controllers\PostController::class, 'destroy']);
Route::post('/comment', [App\Http\Controllers\CommentController::class, 'create']);
