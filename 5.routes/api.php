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

Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);
Route::resource('users.following', 'User\UserFollowingController', ['only' => ['index', 'update', 'destroy']]);
Route::resource('users.followers', 'User\UserFollowerController', ['only' => ['index']]);
Route::resource('users.posts', 'User\UserPostController', ['only' => ['index']]);

Route::resource('posts', 'Post\PostController', ['except' => ['create', 'edit']]);
Route::resource('posts.comments', 'Post\PostCommentController', ['except' => ['create', 'edit']]);



