<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ChangeNameRequest;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $auth = Auth::user();
        return view('pages/users/settings/index', ['auth' => $auth]);
    }

  public function showChangeNameForm()
    {
      $auth = Auth::user();
      return view('pages/users/settings/name', ['auth' => $auth]);
    }

  public function changeName(ChangeNameRequest $request)
    {
     //ValidationはChangeNameRequestで処理
     //氏名変更処理
    $user = Auth::user();
    $user->name = $request->neme;
    $user->save();
     //homeにリダイレクト
    return redirect()->route('setting')->with('status', __('変更が完了しました'));
  }
}
