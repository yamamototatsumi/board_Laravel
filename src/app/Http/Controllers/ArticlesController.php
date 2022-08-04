<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Consts\Success;
use App\Consts\Error;
use App\Consts\Link;

class ArticlesController extends Controller
{
  public function __construct()
  {
    $this->models = new Article();
    $this->commentModels = new Comment();
  }

  public function index() {
    $data = $this->models->PagerSystem();
    var_dump("AAA");
    return view('pages/articles/index',['data'=>$data]);
  }

  public function getInsert(){
    return view('pages/articles/insert');
  }

  public function insert(Request $request) { 
    // $title = $this->inputCheck($_POST["title"]);
    // $content = $this->inputCheck($_POST["content"]);
    var_dump(session('id'));
    $this->models->insert($request->input('title'), session('id'), $request->input('content'));
    return view('pages/results/finish',['data'=>Success::REGISTER,'link'=>Link::ARTICLES]);
  }  

  public function search(Request $request) {
    $data = $this->models->search($request->input('keyword'));
    return view('pages/articles/search',['data'=>$data]);
  }

  public function detail(Request $request) {
    $data = $this->models->detail($request->input('id'));
    if(session('id') === $data->user_id){
      $data["edit"] = "<a href='updateArticle?id=".$this->data['article_ID']."'>編集</a>";
      $data["delete"] = "<a href='deleteArticle?id=".$this->data['article_ID']."'>削除</a>";
    }
    $data["stmt"]=$this->models->index($request->input('id'));
    require_once ( dirname(__FILE__) . $_ENV["ARTICLES_DIRECTRY"] . "article_comment.php"); 
  }
}
