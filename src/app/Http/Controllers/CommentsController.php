<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use App\Consts\Success;
use App\Consts\Error;
use App\Consts\Link;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
  public function __construct()
  {
    $this->models = new Comment();
    $this->articleModels = new Article();
  }

  public function insert(Request $request) {
    $this->models->insert($request->main, $request->id, Auth::user()->user_id);
    return view('results/finish',['data'=>__("messages.success.register"), 'link'=>Link::COMMENTS.$request->id]);
  }

  public function dispUpdate(Request $request) {
    $data=$this->models->detail($request->id);
    if ($data->user_id === Auth::user()->user_id) {
        return view('comments/update', ['data'=>$data,'request'=>$request]);
    }else{
      return view('results/error',['data'=>__("messages.error.others"),'link'=>Link::ARTICLES]);
    }
  }

  public function update(Request $request) {
    $this->models->put($request->main, $request->id);
    return view('results/finish',['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }

  public function delete(Request $request) {
    $this->models->remove($request->id);
    return view('results/finish', ['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }
}
