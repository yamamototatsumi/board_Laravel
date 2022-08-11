<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Consts\Link;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->models = new User();

    $this->articleModels = new Article();
  }

  public function getMyPage() {
    return view('dashboard');
  }

  public function getTopPage() {
    $data['user'] = $this->models->month();
    $data['article'] = $this->articleModels->month();
    return view('index',['data'=>$data]);
  }

  public function dispUpdate(){
      return view('users/update',['data'=>Auth::user()->name,'id'=>Auth::user()->user_id]);
  }

  public function update(UserRequest $request) {
    $this->models->put($request);
    return view('results/finish',['data'=>__("messages.success.name"), 'link'=>Link::MYPAGE]);
  }
}
