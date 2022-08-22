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
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
  public function index() {
    $user = User::get();
    return response()->json($user, Response::HTTP_OK);
  }

  public function store(Request $request) {
    $attributes = $request->only(['email', 'name', 'password','user_id','api_token','email_verified_at']);
    User::create($attributes);
    $user = User::orderby('desc')->first();
    return response()->json($user, Response::HTTP_CREATED);
  }

  public function update(UserRequest $request) {
    $user = User::where('email',$request->email);
    $user->update(['name' => $request->name,'password'=>Hash::make($request->pass)]);
    return response()->json($user, Response::HTTP_CREATED);
  }
  }


