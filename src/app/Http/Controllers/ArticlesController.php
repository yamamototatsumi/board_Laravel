<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\insertArticleRequest;
use App\Consts\Link;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleIdentificationRequest;





class ArticlesController extends Controller
{
  public function index() {
    $datas = $this->article->index()->orderby('id','desc')
    ->paginate(Link::MAXVIEW);
    return view('articles/index',['data'=>$datas]);
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
    $this->article->insert($request->title, Auth::user()->user_id, $request->content);
    return view('results/finish',['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }  

  public function search(Request $request) {
    $data = $this->article->search($request->input('keyword'))->paginate(10);;
    return view('articles/search',['data'=>$data]);
  }

  public function detail(Request $request, int $id) {
    $token = $request->bearerToken();
    dd($token);
    $datas = $this->article->detail($id)->get();
      foreach ($datas as $data) {
        $data->user;
      }
    $comment = $this->comment->index($id)->get();
    return view('articles/detail',['data'=>$data,'comment'=>$comment,'request'=>$request]);
  }

  public function dispUpdate(ArticleIdentificationRequest $request) {
    $datas = $this->article->detail($request->id)->get();
    foreach ($datas as $data) {
        $data->user;
    }
      return view('articles/update',['data'=>$data,'request'=>$request,]);
  }

  public function update(Request $request) {
    $this->article->put($request);
    return view('results/finish',['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }

  public function delete(Request $request) {
    $this->article->remove($request->id);
    return view('results/finish',['data'=>__("messages.success.register"),'link'=>Link::ARTICLES]);
  }

}
