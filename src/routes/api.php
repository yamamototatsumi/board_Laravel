<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersController;
use App\Http\Controllers\api\ArticlesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CommentsController;

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
// Route::get('/',[AuthController::class, 'authenticate']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





//Usersのルート
Route::get('/users', [UsersController::class, 'index']);

Route::post('/users', [UsersController::class, 'insert']);





//Articlesのルート
Route::get('/articles', [ArticlesController::class, 'index']);

Route::get('/articles/detail/{id}',[ArticlesController::class, 'detail']);

Route::post('/articles',[ArticlesController::class, 'insert']);

Route::patch('/articles',[ArticlesController::class, 'update']);

Route::delete('/articles',[ArticlesController::class, 'delete']);


//Commentsのルート
Route::get('/comments/{id}',[CommentsController::class, 'index']);

Route::post('/comments',[CommentsController::class, 'insert']);

Route::patch('/comments',[CommentsController::class, 'update']);

Route::delete('/comments',[CommentsController::class, 'delete']);