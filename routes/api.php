<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\SubsectionController;
use App\Http\Controllers\Api\TopicController;
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

Route::get('/sections', [SectionController::class, 'index']);
Route::get('/section/{id}', [SectionController::class, 'show']);
Route::get('/section/{id}/subsections', [SectionController::class, 'showSubsections']);

Route::get('/subsections', [SubsectionController::class, 'index']);
Route::get('/subsection/{id}', [SubsectionController::class, 'show']);
Route::get('/subsection/{id}/topics', [SubsectionController::class, 'showTopics']);

Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topic/{id}', [TopicController::class, 'show']);
Route::get('/topic/{id}/posts', [TopicController::class, 'showPosts']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/post/{id}', [PostController::class, 'show']);
Route::get('/post/{id}/user', [PostController::class, 'showUser']);
Route::get('/post/{id}/topic', [PostController::class, 'showTopic']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth.api'], function() {
    Route::post('/post', [PostController::class, 'create']);
    Route::post('/topic', [TopicController::class, 'create']);
    Route::patch('/post/{id}', [PostController::class, 'edit']);
    Route::delete('/post/{id}', [PostController::class, 'delete']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
