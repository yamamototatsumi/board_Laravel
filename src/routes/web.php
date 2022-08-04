<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PreUsersController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified','auth'])->name('dashboard');




Route::get('/users/mypage', [UsersController::class, 'getMyPage']);

Route::get('/articles/index',[ArticlesController::class, 'index']);

// Route::get('/', [UsersController::class, 'getTopPage']);

// Route::get('/users/login',[UsersController::class, 'getLogin']);

// Route::get('/preUsers/signUp',[PreUsersController::class, 'getSignUp']);

// Route::get('/users/insert/{id?}',[UsersController::class, 'getInsert']);
Route::get('/articles/insert/',[ArticlesController::class, 'getInsert'])
->middleware((['verified','auth']))->name('/articles/insert');

// Route::post('/users/insert',[UsersController::class, 'insert']);

// Route::post('/preUsers/signUp',[PreUsersController::class, 'insert']);
Route::post('/articles/insert',[ArticlesController::class, 'insert']);





// Route::get('/articles/index',[PreUsersController::class, 'getSignUp']);



require __DIR__.'/auth.php';
