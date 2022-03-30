<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\SubsectionController;
use App\Http\Controllers\Api\TopicController;
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

Route::get('/sections', [SectionController::class, 'index']);
Route::get('/section/{id}', [SectionController::class, 'show']);

Route::get('/subsections', [SubsectionController::class, 'index']);
Route::get('/subsection/{id}', [SubsectionController::class, 'show']);

Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topic/{id}', [TopicController::class, 'show']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/post/{id}', [PostController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);