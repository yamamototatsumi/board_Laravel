<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Consts\Link;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{

  public function getMyPage() {
    return view('dashboard');
  }

  public function dispUpdate(){
      return view('users/update',['data'=>Auth::user()->name,'id'=>Auth::user()->user_id]);
  }

  public function update(UserRequest $request) {
    $this->user->put($request);
    return view('results/finish',['data'=>__("messages.success.name"), 'link'=>Link::MYPAGE]);
  }

  public function getTopPage(){
    //userの当月カウントをするスコープへ飛ばす
    $userCount = User::Month(date('Y-M'))
    ->get()->groupBy('created_at',date('Y-M'))
    ->count();
    //articleの当月カウントをするスコープへ飛ばす
    $articleCount = Article::Month(date('Y-M'))
    ->get()->groupBy('created_at',date('Y-M'))
    ->count();
    return view('index',['article'=>$articleCount,'user'=>$userCount]);
  }
  
}
