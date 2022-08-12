<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consts\Link;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
  public function insert(Request $request) {
    $this->comment->insert($request->main, $request->id, Auth::user()->user_id);
    return view('results/finish',['data'=>__("messages.success.register"), 'link'=>Link::ARTICLES]);
  }

  public function dispUpdate(Request $request) {
    $data = $this->comment->detail($request->id)->first();
      return view('comments/update', ['data'=>$data,'request'=>$request]);
  }

  public function update(Request $request) {
    $this->comment->put($request->main, $request->id);
    return view('results/finish',['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }

  public function delete(Request $request) {
    $this->comment->remove($request->id);
    return view('results/finish', ['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }
}
