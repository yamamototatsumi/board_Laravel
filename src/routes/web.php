<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminUserDataController;
use App\Models\Article;


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

//誰でも閲覧可能

Route::get('/',[UsersController::class, 'getTopPage']);

Route::get('/articles/index',[ArticlesController::class, 'index'])
->name('articles/index');

Route::post('articles/search',[ArticlesController::class, 'search'])
->name('articles/search');




//ログイン済みならダッシュボードへリダイレクト

Route::middleware('guest')->group(function () {

  Route::get('users/insert', [RegisteredUserController::class, 'create'])
  ->name('users/insert');

  Route::post('register', [RegisteredUserController::class, 'store'])
  ->name('users/insert');

  Route::get('login', [AuthenticatedSessionController::class, 'create'])
  ->name('login');

  Route::post('login', [AuthenticatedSessionController::class, 'store'])
  ->name('login');

  Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
  ->name('password.request');

  Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
  ->name('password.email');

  Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
  ->name('password.reset');

  Route::post('reset-password', [NewPasswordController::class, 'store'])
  ->name('password.update');
});



//ログインユーザーのみ閲覧可能

Route::middleware('auth')->group(function () {

  Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
  ->name('verification.notice');

  Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
  ->middleware(['signed', 'throttle:6,1'])
  ->name('verification.verify');

  Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
  ->middleware('throttle:6,1')
  ->name('verification.send');

  Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
  ->name('password.confirm');

  Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
  ->name('logout');

});


//認証済みユーザーのみ閲覧可能

Route::middleware(['auth','verified'])->group(function () {

  Route::get('/dashboard', [UsersController::class, 'getMyPage'])
  ->name('dashboard');

  Route::get('/users/update',[UsersController::class, 'dispUpdate'])
  ->name('users/update');

  Route::get('/articles/detail/{id}',[ArticlesController::class, 'detail'])
  ->name('articles/detail');

  Route::get('/articles/insert/',[ArticlesController::class, 'getInsert'])
  ->name('articles/insert');

  Route::post('/articles/update/',[ArticlesController::class, 'dispUpdate'])
  ->name('articles/update');

  Route::post('/comments/update/',[CommentsController::class, 'dispUpdate'])
  ->name('comments/update');

  Route::post('/articles/insert',[ArticlesController::class, 'insert'])
  ->middleware('transaction')->name('articles/insert');

  Route::post('/comments/insert',[CommentsController::class, 'insert'])
  ->middleware('transaction')->name('comments/insert');

  Route::patch('/users',[UsersController::class, 'update'])
  ->middleware('web','transaction')->name('users');

  Route::patch('/articles',[ArticlesController::class, 'update'])
  ->middleware('transaction')->name('articles');

  Route::patch('/comments',[CommentsController::class, 'update'])
  ->middleware('transaction')->name('comments');

  Route::delete('/comments',[CommentsController::class, 'delete'])
  ->name('comments/delete');

  Route::delete('articles',[ArticlesController::class, 'delete'])
  ->middleware('transaction')->name('articles/delete');
});

//ここからアドミン追加
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);

Route::post('/login/admin', [LoginController::class, 'adminLogin']);
Route::post('/register/admin', [RegisterController::class, 'registerAdmin'])->name('admin-register');

Route::view('/admin', 'admin')->middleware('auth:admin')->name('admin-home');

Route::get('/admin/user',[AdminUserDataController::class, 'index'])->middleware('auth:admin')->name('admin/user');

Route::post('/admin/user',[AdminUserDataController::class, 'importCsv'])->middleware('auth:admin')->name('admin/user');

