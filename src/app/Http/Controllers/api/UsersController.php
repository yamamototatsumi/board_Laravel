<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
  public function index() {
    $user = User::get();
    return response()->json($user, 200);
  }

  public function insert(Request $request) {
    $api_token = Hash::make(Str::random(60));
      $user = User::create(['user_id'=>$request->userId,
                            'email'=>$request->email,'password'=>$request->pass,
                            'name'=>$request->name,'api_token'=>$api_token]);


  }

  // public function getTopPage(){
  //   //userの当月カウントをするスコープへ飛ばす
  //   $userCount = User::Month(date('Y-M'))
  //   ->get()->groupBy('created_at',date('Y-M'))
  //   ->count()->toJson(JSON_PRETTY_PRINT);
  //   //articleの当月カウントをするスコープへ飛ばす
  //   $articleCount = Article::Month(date('Y-M'))
  //   ->get()->groupBy('created_at',date('Y-M'))
  //   ->count();
  //   return view('index',['article'=>$articleCount,'user'=>$userCount]);
  // }
}
