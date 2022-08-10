<?php

namespace App\Http\Controllers;

use App\Models\PreUser;
use App\Models\User;
use App\Consts\Success;
use App\Consts\Error;
use App\Consts\Link;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->models = new User();
    $this->preUserModels = new PreUser();
    $this->articleModels = new Article();
  }

  public function getMyPage() {
    return view('dashboard');
  }

  public function getTopPage() {
    $data['user'] = $this->models->month();
    $data['article'] = $this->articleModels->month();
    return view('pages/index',['data'=>$data]);
  }

  public function getUpdate(){
      return view('pages/users/update',['data'=>Auth::user()->name]);
  }

  public function update(UserRequest $request) {
    $pass = Hash::make($request->pass);
    $data = $this->models->selectPass(Auth::user()->user_id);
    if (Hash::check($request->oldpass, $data->password)) {
        $this->models->put(Auth::user()->user_id, $request->name, $pass);
        return view('pages/results/finish',['data'=>Success::NAME, 'link'=>Link::MYPAGE]);
    } else {
        return view('pages/results/error',['data'=>Error::PASSWORD,'link'=>Link::UPDATE]);
    }
  }
}
