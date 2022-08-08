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
    return view('pages/results/finish',['data'=>Success::REGISTER, 'link'=>Link::COMMENTS.$request->id]);
  }

  public function getUpdate(Request $request) {
    $data=$this->models->detail($request->id);
    if ($data->user_id === Auth::user()->user_id) {
        return view('pages/comments/update', ['data'=>$data,'request'=>$request]);
    }
  }

  public function update(Request $request) {
    $this->models->put($request->main, $request->id);
    return view('pages/results/finish',['data'=>Success::REGISTER,'link'=>Link::ARTICLES]);
  }

  public function delete(Request $request) {
    $this->models->remove($request->id);
    return view('pages/results/finish', ['data'=>Success::REGISTER,'link'=>Link::ARTICLES]);
  }
}
