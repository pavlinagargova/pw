<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\TagController;
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

Route::group(['middleware' => 'role:Admin'], function() {
    Route::apiResources([
        'posts' => PostController::class,
        'comments' => CommentController::class,
        'tags' => TagController::class,
    ]);
});

Route::group(['middleware' => 'role:Admin,Regular'], function() {
    Route::get("tags/filter/{tagID}", 'App\Http\Controllers\API\TagController@filter');
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{post}', [PostController::class, 'show']);
    Route::post('comment/{comment}', [CommentController::class, 'store']);
});
