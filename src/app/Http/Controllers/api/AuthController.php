<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;


class AuthController extends Controller
{
  public function authenticate(RegisterUserRequest $request)
  {
      $credentials = $request->validate([
          'email' => ['required', 'email'],
          'password' => ['required'],
      ]);

      if (Auth::attempt($credentials)) {
          $token = $request->user()->createToken('token-name');
          return response()->json(['api_token' => $token->plainTextToken], 200);
      }

      return response()->json(['api_token' => null], 401);
    }

    /**
     * Handle an incoming registration request.
     *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse
    *
    * @throws \Illuminate\Validation\ValidationException
    */
  public function store(RegisterUserRequest $request)
  {   
    $pass = Hash::make($request->password);
    $id = str()->uuid();
    $user = $this->models->insert($request->name,$request->email,$pass,$id);
    event(new Registered($user));
    Auth::login($user);
    return redirect(RouteServiceProvider::HOME);
  } 

}