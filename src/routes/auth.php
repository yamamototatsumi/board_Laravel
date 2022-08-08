<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Auth;

Route::middleware('guest')->group(function () {

    Route::get('users/insert', [RegisteredUserController::class, 'create'])
                ->name('users/insert');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});




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

    Route::get('users/mypage', [UsersController::class, 'getMyPage']);

    Route::post('articles/search',[ArticlesController::class, 'search']);

    Route::get('articles/detail/{id?}',[ArticlesController::class, 'detail']);

    Route::post('comments/insert',[CommentsController::class, 'insert'])
      ->middleware((['verified']))->name('comments/insert');

    Route::get('/articles/insert/',[ArticlesController::class, 'getInsert'])
    ->middleware((['verified']))->name('articles/insert');

    Route::get('/articles/update',[ArticlesController::class, 'getUpdate']);

    Route::patch('/users/update',[UsersController::class, 'update'])
    ->name('users/update');

    Route::patch('/articles/update',[ArticlesController::class, 'update'])
    ->name('articles/update');

    Route::post('/articles/insert',[ArticlesController::class, 'insert']);

    Route::get('/articles/delete',[ArticlesController::class, 'delete'])
    ->name('articles/delete');

    Route::get('/comments/update',[CommentsController::class, 'getUpdate'])
    ->name('comments/delete');

    Route::get('/comments/delete',[CommentsController::class, 'delete'])
    ->name('comments/delete');

    Route::patch('comments/update',[CommentsController::class, 'update'])
    ->name('comments/update');

});
