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



Route::get('/', [UsersController::class, 'getTopPage']);

Route::get('/users/login',[UsersController::class, 'getLogin']);

Route::get('/preUsers/signUp',[PreUsersController::class, 'getSignUp']);

Route::get('/users/insert/{id?}',[UsersController::class, 'getInsert']);

Route::post('/users/insert',[UsersController::class, 'insert']);

Route::post('/preUsers/signUp',[PreUsersController::class, 'insert']);




Route::get('/articles/index',[PreUsersController::class, 'getSignUp']);




// Route::get('/',function(){
//   return view('index');
// });



// Route::get('/preUsers/signup', function () {
//   return view('index');
// });







// if($path === 'admin/user/download' && $method === 'POST'){
//   return $admin_user_data_controller->download();
// }

// if($path === 'admin/article/download' && $method === 'POST'){
//   return $admin_article_controller->download();
// }

// $users_controller->displayHeadder();

// if(mb_substr($parse['path'],-1) === '/'){
//   return $users_controller->getTopPage();
// }

// if($path === 'index'){
//   return $users_controller->getTopPage();
// }

// if($path === 'login' && $method === 'GET'){
//   return $users_controller->getLogin();
// }elseif($path === 'login' && $method === 'POST'){
//   return $users_controller->loginPost();   
// }

// if($path === 'mypage'){
//   return $users_controller->getMypage();   
// }

// if($path === 'logout'){
//   return $users_controller->getLogout();   
// }

// if($path === 'updateUser' && $method === 'GET'){
  
// }

// if($path === 'user' && $method === 'GET'){
//   return $users_controller->getUser();   
// }elseif($path === 'user' && $method === 'POST'){
//   return $users_controller->addUser();   
// }

// if($path === 'signUp' && $method === 'GET'){
//   return $pre_users_controller->getSignUp();   
// }elseif($path === 'signUp' && $method === 'POST'){
//   return $pre_users_controller->addPreUsers();   
// }

// if($path === 'article' && $method === 'GET'){
//   return $articles_controller->index();   
// }elseif($path === 'article' && $method === 'POST'){
//   return $articles_controller->searchArticle();   
// }

// if($path === 'newPost' && $method === 'GET'){
//   return $articles_controller->displayNewPost();   
// }elseif($path === 'newPost' && $method === 'POST'){
//   return $articles_controller->addArticle();   
// }

// if($path === 'comment' && $method === 'GET'){
//   return $articles_controller->indexComment();
// }elseif($path === 'comment' && $method === 'POST'){
//   return $comments_controller->addComment();
// }

// if($path === 'updateArticle' && $method === 'GET'){
//   return $articles_controller->getUpdateArticle();
// }elseif($path === 'updateArticle' && $method === 'POST'){
//   return $articles_controller->updateArticle();
// }

// if($path === 'deleteArticle'){
//   return $articles_controller->deleteArticle();
// }

// if($path === 'deleteComment'){
//   return $comments_controller->deleteComment();
// }

// if($path === 'updateComment' && $method === 'GET'){
//   return $comments_controller->getUpdateComment();
// }elseif($path === 'updateComment' && $method === 'POST'){
//   return $comments_controller->updateComment();
// }

// if($path === 'admin' && $method === 'GET'){
//   return $admin_user_data_controller->getTop();
// }

// if($path === 'admin/user' && $method === 'GET'){
//   return $admin_user_data_controller->getUser();
// }

// if($path === 'admin/article' && $method === 'GET'){
//   return $admin_article_controller->getArticle();
// }

// if($path === 'admin/user/upload' && $method === 'POST'){
//   return $admin_user_data_controller->insert();
// }

// if($path === 'admin/article/upload' && $method === 'POST'){
//   return $admin_article_controller->insert();
// }

// else{
//   $users_controller->getError();
// }
