<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;



class AuthController extends Controller
{
  use HasApiTokens, HasFactory, Notifiable;

  public function authenticate(RegisterUserRequest $request)
  {
      if (Auth::attempt($request)) {
          $token = $request->user()->createToken('token-name');
          dd($token);
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
    $user = User::create(['user_id'=>str()->uuid(),'email'=>$request->email,'password'=>$pass,'name'=>$request->name,'api_token' => Str::random(60),]);
    event(new Registered($user));
    Auth::login($user);
    return redirect(RouteServiceProvider::HOME);

  } 

}