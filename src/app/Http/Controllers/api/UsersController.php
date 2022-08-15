<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Article;

class UsersController extends Controller
{
  public function getUsersAll() {
    $user = User::first(['name','email'])->toJson(JSON_PRETTY_PRINT);
    return response($user, 200);
  }

  public function getTopPage(){
    //userの当月カウントをするスコープへ飛ばす
    $userCount = User::Month(date('Y-M'))
    ->get()->groupBy('created_at',date('Y-M'))
    ->count()->toJson(JSON_PRETTY_PRINT);
    //articleの当月カウントをするスコープへ飛ばす
    $articleCount = Article::Month(date('Y-M'))
    ->get()->groupBy('created_at',date('Y-M'))
    ->count();
    return view('index',['article'=>$articleCount,'user'=>$userCount]);
  }
}
