<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\AuthController;

Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);
Route::resource('users.posts', 'User\UserPostController', ['except' => ['create', 'edit']]);
Route::resource('posts', 'Post\PostController', ['except' => ['create', 'edit']]);
Route::resource('posts.comments', 'Post\PostCommentController', ['except' => ['create', 'edit']]);