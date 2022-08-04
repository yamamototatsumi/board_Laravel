<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use App\Consts\Success;
use App\Consts\Error;
use App\Consts\Link;

class CommentsController extends Controller
{
  public function __construct()
  {
    $this->models = new Comment();
    $this->articleModels = new Article();
  }
  public function index(Request $request) {
    $data = $this->articleModels->selectArticleWithUser($request->input('id'));
    if(session('id') === $data->user_id){
      $data["edit"] = "<a href='updateArticle?id=".$this->data['article_ID']."'>編集</a>";
      $data["delete"] = "<a href='deleteArticle?id=".$this->data['article_ID']."'>削除</a>";
    }
    $data["stmt"]=$this->models->index($request->input('id'));
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "article_comment.php"); 
  }

}
