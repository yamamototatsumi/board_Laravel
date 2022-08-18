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
// Route::get('/',[AuthController::class, 'authenticate']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});


Route::middleware('auth:api', 'admin_auth')->group(function(){
  Route::get('/admin', function(){
      return 'you are admin user!';
    });
});


//////誰でもアクセスできる
Route::get('/articles', [ArticlesController::class, 'index']);

Route::get('/articles/detail/{article}',[ArticlesController::class, 'detail']);



///// user権限、admin権限のあるユーザの操作
Route::middleware('auth:api')->group(function(){
  

//Articlesのルート

Route::post('/articles',[ArticlesController::class, 'insert']);

Route::patch('/articles/{article}',[ArticlesController::class, 'update']);

Route::delete('/articles/{article}',[ArticlesController::class, 'delete']);



//Usersのルート
Route::get('/users', [UsersController::class, 'index'])->middleware('admin_auth');

Route::post('/users', [UsersController::class, 'insert']);

Route::patch('/users', [UsersController::class, 'update']);



//Commentsのルート
Route::get('/comments/{comment}',[CommentsController::class, 'index']);

Route::post('/comments',[CommentsController::class, 'insert']);

Route::patch('/comments/{comment}',[CommentsController::class, 'update']);

Route::delete('/comments/{comment}',[CommentsController::class, 'delete']);

});

Route::post('login', [LoginController::class, 'login']);



