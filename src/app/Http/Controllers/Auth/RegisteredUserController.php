<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\RegisterUserRequest;


class RegisteredUserController extends Controller
{
  public function __construct()
  {
    $this->models = new User;
  }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
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
