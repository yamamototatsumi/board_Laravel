<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreUser;
use Illuminate\Support\Facades\Mail;
use Public\Language;


class PreUsersController extends Controller
{
  public function __construct()
  {
    $this->models =new PreUser();
  }

  public function getSignUp()
  {
      return view('pre_users/signup');
  }

  public function getTopPage()
  {
      return view('index');
  }

  public function insert(Request $request)
  {
    $email=$this->models->check($request->input('email'));
    if(!$email){
      $userId = str()->uuid();
      $Preuser = $this->models->insert($userId,$request->input('email'));
      $url = $this->sendmail($userId);
      $msg = "メールの送信が行われました";
    }else{
      $msg="miss";
    }
    return view('pre_users/register',['msg'=>$msg,'userId'=>$userId]);
  }

  public function sendMail($userId)
  {
      $email = 'hello@example.com';
      Mail::send('pre_users/mail', [
          'userId' => $userId
      ], function ($message) use ($email) {
          $message->to($email)
              ->subject('仮登録完了のお知らせ');
      });
  }
}
