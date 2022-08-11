<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\insertArticleRequest;
use App\Consts\Link;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleIdentificationRequest;

class ArticlesController extends Controller
{
  private Article $models;
  public function __construct(Article $Article)
  {
    $this->models = $Article;
    $this->commentModels = new Comment();
  }

  public function index() {
    $data = $this->models->PagerSystem();
    return view('articles/index',['data'=>$data]);
  }

  public function getInsert(){
    return view('articles/insert');
  }

    /**
   * Handle an incoming registration request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */

  public function insert(insertArticleRequest $request) { 
    $this->models->insert($request->title, Auth::user()->user_id, $request->content);
    return view('results/finish',['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }  

  public function search(Request $request) {
    $data = $this->models->search($request->input('keyword'));
    return view('articles/search',['data'=>$data]);
  }

  public function detail(Request $request, int $id) {
    $data = $this->models->detail($id);
    $comment = $this->commentModels->index($id);
    return view('articles/detail',['data'=>$data,'comment'=>$comment,'request'=>$request]);
  }

  
  public function dispUpdate(ArticleIdentificationRequest $request) {
    $data = $this->models->detail($request->id);
      return view('articles/update',['data'=>$data,'request'=>$request,]);
  }

  public function update(Request $request) {
    $this->models->put($request);
    return view('results/finish',['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }

  public function delete(Request $request) {
    $this->models->remove($request->id);
    return view('results/finish',['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }

}