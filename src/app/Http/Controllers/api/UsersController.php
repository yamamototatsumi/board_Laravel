<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
  public function index() {
    $user = User::get();
    return response()->json($user, 200);
  }

  public function insert(Request $request) {
    $api_token = Str::random(60);
    $user_id = str()->uuid();
    User::create(['user_id'=>$user_id,
                  'email'=>$request->email,'password'=>bcrypt($request->pass),
                  'name'=>$request->name,'api_token'=>$api_token,
                  'email_verified_at'=>now()]);
    $user = User::where('user_id', $user_id) ->first();
    return response()->json($user, 200);
  }


  public function update(UserRequest $request) {
    User::where('email', $request->email)
    ->update(['name' => $request->name,'password'=>Hash::make($request->pass)]);
    return response()->json(["message" => "更新完了"], 201);
  }


  }


