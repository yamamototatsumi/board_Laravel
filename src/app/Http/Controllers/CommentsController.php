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
    return view('pages/results/finish',['data'=>Success::REGISTER, 'link'=>Link::COMMENTS]);
  }

}
