<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreUser;
use Illuminate\Support\Facades\Mail;
use App\Consts\Success;
use App\Consts\Error;
use App\Consts\Link;


class PreUsersController extends Controller
{
  public function __construct()
  {
    $this->models =new PreUser();
  }

  public function getSignUp()
  {
      return view('pages/pre_users/signup');
  }

  public function getTopPage()
  {
      return view('pages/index');
  }

  public function insert(Request $request)
  {
    $email=$this->models->check($request->input('email'));
    if(!$email){
      $userId = str()->uuid();
      $this->models->insert($userId,$request->input('email'));
      $this->sendmail($userId);
      var_dump($userId);
      return view('pages/pre_users/insert',['data'=>Success::MAIL,'userId'=>$userId]);
    }else{
      return view('pages/results/error',['data'=>Error::ALRADY,'link'=>Link::TOP]);
    }
  }

  public function sendMail($userId)
  {
      $email = 'hello@example.com';
      Mail::send('pages/pre_users/mail', [
          'userId' => $userId
      ], function ($message) use ($email) {
          $message->to($email)
              ->subject('仮登録完了のお知らせ');
      });
  }
}
