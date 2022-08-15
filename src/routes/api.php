<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersController;
use App\Http\Controllers\api\ArticlesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/users', [UsersController::class, 'getUsersAll']);

Route::get('/articles', [ArticlesController::class, 'index'])
->name('api/articles');

Route::get('/articles/detail/{id}',[ArticlesController::class, 'detail'])
->name('api/articles/detail');

//認証済みユーザーのみ閲覧可能

Route::middleware(['auth','verified'])->group(function () {

  // Route::get('/dashboard', [UsersController::class, 'getMyPage'])
  // ->name('dashboard');

  // Route::get('/users/update',[UsersController::class, 'dispUpdate'])
  // ->name('users/update');



  // Route::get('/articles/insert/',[ArticlesController::class, 'getInsert'])
  // ->name('articles/insert');

  // Route::post('/articles/update/',[ArticlesController::class, 'dispUpdate'])
  // ->name('articles/update');

  // Route::post('/comments/update/',[CommentsController::class, 'dispUpdate'])
  // ->name('comments/update');

  // Route::post('/articles/insert',[ArticlesController::class, 'insert'])
  // ->middleware('transaction')->name('articles/insert');

  // Route::post('/comments/insert',[CommentsController::class, 'insert'])
  // ->middleware('transaction')->name('comments/insert');

  // Route::patch('/users',[UsersController::class, 'update'])
  // ->middleware('web','transaction')->name('users');

  // Route::patch('/articles',[ArticlesController::class, 'update'])
  // ->middleware('transaction')->name('articles');

  // Route::patch('/comments',[CommentsController::class, 'update'])
  // ->middleware('transaction')->name('comments');

  // Route::delete('/comments',[CommentsController::class, 'delete'])
  // ->name('comments/delete');

  // Route::delete('articles',[ArticlesController::class, 'delete'])
  // ->middleware('transaction')->name('articles/delete');
});

