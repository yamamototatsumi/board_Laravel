<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreUser;
use App\Models\User;
use App\Consts\Success;
use App\Consts\Error;
use App\Consts\Link;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Http\Requests\ChangeNameRequest;
use App\Providers\RouteServiceProvider;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->models = new User();
    $this->preUserModels = new PreUser();
  }

  public function getMyPage() {
    return view('dashboard');
  }

  public function getTopPage() {
    return view('pages/index');
  }

  // public function getLogin() {
  //   return view('pages/users/login');
  // }
  

  // public function getInsert(Request $request) {
  //   $email = $this->preUserModels->getEmail($request->input('id'));
  //   $user = $this->preUserModels->getId($email);
  //   if (!$user) {
  //       return view('pages/users/insert', ['email'=>$email]);
  //   } else {
  //       return view('pages/results/error',['data'=>Error::ALRADY,'link'=>Link::TOP]);
  //   }
  // }
      /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

  // public function insert(Request $request) {
  //   $email = $this->models->check($request->email);
  //   if(!$email){
  //     $pass = Hash::make($request->pass);
  //     $userId = str()->uuid();
  //     $this->models->insert($userId,$request->email,$pass,$request->name);
  //     return view('pages/results/finish',['data'=>Success::REGISTER,'link'=>Link::LOGIN]);
  //   }else{
  //     $data = Error::ALRADY;
  //     return view('pages/results/error',['data'=>$data,'link'=>Link::TOP]);
  //   }
  // }

  // public function postLogin(Request $request) {
  //   $data = $this->passCheck($request->input('email'),$request->input('pass'));
  //   if($request->input('email') === "admin.admin@gmail.com"){
  //     $headerdata = Error::NONE;       // 多分いらん気がする
  //     return view('pages/admin/index');
  //   }
  //   else{
  //     return view('pages/results/finish',['data'=>$data['msg'],'link'=>$data['link']]);
  //   }
  // }

  // public function passCheck($email,$pass) :array {
  //     $user = $this->models->passCheck($email);
  //     if (Hash::check($pass, $user->pass)) {
  //         session()->put('id', $user->user_id);
  //         $data['msg'] = Success::LOGIN;
  //         $data['link'] = Link::MYPAGE;
  //     } else {
  //         $data['msg'] = Error::DIFFERENT;
  //         $data['link'] = Link::LOGIN;
  //     }
  //     return $data;
  // }

  // public function loginCheck() :bool {
  //   $flag =false;
  //   if (session('id')) {
  //     $flag = true;
  //   }
  //   return $flag;
  // }

  // public function getMypage(){
  //   $data = $this->getMyname();
    // $data["usercount"] = $this->models->monthUser();
    // $data["articlecount"] = $this->articleModels -> monthArticle();
  //   return view('pages/users/mypage',['data'=>$data]);
  // }

  // public function getMyname() :array{
  //     if (session('id')) {
  //         $data["name"] = $this->models->selectName(session('id'));//名前が入ってる
  //         $data["link"] =  Link::LOGOUT;
  //     } else {
  //         $data["name"] = Error::LOGIN;
  //         $data["link"] = Link::LOGIN;
  //     }
  //     return $data;
  // }

  public function getUpdate(){
      return view('pages/users/update',['data'=>Auth::user()->name]);
  }



  public function update(Request $request) {
    $pass = Hash::make($request->pass);
    $data = $this->models->selectUserNameWithPass(Auth::user()->user_id);
    if (Hash::check($request->oldpass, $data->password)) {
        $this->models->put(Auth::user()->user_id, $request->name, $pass);
        return view('pages/results/finish',['data'=>Success::NAME, 'link'=>Link::MYPAGE]);
    } else {
        return view('pages/results/error',['data'=>Error::PASSWORD,'link'=>Link::UPDATE]);
    }
  }




}
