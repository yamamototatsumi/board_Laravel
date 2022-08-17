<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }



    /**
     * 管理者ログイン用
     */
    public function showAdminLoginForm()
    {
        return view('auth.login', ['authgroup' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admin');
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return back()->withInput($request->only('email', 'remember'));
    }










    public function dispLogin()
    {
        return view('auth.login');
    }




    public function login(Request $request) {

      $credentials = $request->only(['email', 'password']); //requestからemail,passwordだけ取ってくる。
      $guard = $request->guard;

      //attempt()でユーザを認証する。
      if(Auth::guard($guard)->attempt($credentials)) {

          //ログインをする度にapi_tokenのアップデート
          $user_info = User::whereEmail($request->email)->first(); //userのメールアドレスの取得
          $user_id = $user_info->id;

          //usersテーブルから対象userを見つけてapi_tokenを再生成する。
          $user = User::find($user_id);
          // $user->api_token = Str::random(60);
          // $user->save();


          // $request->session()->regenerate();

          //loginが成功するとtokenと共に情報をjsonで返す。
          return response()->json([
              'token' => $user->api_token,
              'id' => $user->id,
              'name' => $user->name,
              'email' => $user->email,
          ], Response::HTTP_OK);
      }

      return 'login failed!';
  }

}
