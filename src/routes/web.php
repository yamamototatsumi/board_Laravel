<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticlesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[UsersController::class, 'getTopPage']);

Route::get('/dashboard', [UsersController::class, 'getMyPage'])
->middleware(['verified','auth'])->name('dashboard');

Route::get('/users/update',[UsersController::class, 'getUpdate'])
->name('users/update');



Route::get('/articles/index',[ArticlesController::class, 'index'])
->name('articles/index');

Route::get('/', [UsersController::class, 'getTopPage']);



//認証済みか判定するauth.phpへ飛ばす
require __DIR__.'/auth.php';
