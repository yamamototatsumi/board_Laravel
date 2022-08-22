<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersController;
use App\Http\Controllers\api\ArticlesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CommentsController;
use App\Http\Controllers\Auth\LoginController;
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


///// user権限、admin権限のあるユーザの操作
Route::middleware('auth:api')->group(function(){

  //Articlesのルート
  Route::resource('articles', ArticlesController::class)-> only(['index', 'store', 'update', 'destroy']);

  //Usersのルート
  Route::resource('users', UsersController::class)-> only(['index', 'store', 'update']);

  //Commentsのルート
  Route::resource('comments', CommentsController::class)-> only(['index', 'store', 'update', 'destroy']);

});

  Route::post('login', [LoginController::class, 'login']);



