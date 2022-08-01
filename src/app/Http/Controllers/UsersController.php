<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreUser;
use App\Models\User;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->models = new User();
    $this->preUserModels = new PreUser();
  }

  public function getTopPage() {
    return view('index');
    echo \Lang::get("const.exception");
  }

  public function getLogin() {
    return view('users/login');
  }

  public function getInsert(Request $request) {
    $email = $this->preUserModels->getEmail($request->input('id'));
    $user = $this->preUserModels->getId($email);
    if (!$user) {
        return view('users/insert', ['email'=>$email]);
    } else {
        $msg = config('const.already');
        return view('error',['msg'=>$msg]);
    }
  }

  public function insert(Request $request) {
    $email = $this->models->check($request->input('email'));
    if(!$email){
      $pass = password_hash($request->input('pass'),PASSWORD_DEFAULT);
      $userId = str()->uuid();
      $this->models->insert($userId,$request->input('email'),$pass,$request->input('name'));
      $msg = "登録完了";
      return view('finish',['msg'=>$msg]);
    }else{
      $msg="miss";
      return view('error',['msg'=>$msg]);
    }
  }

}
