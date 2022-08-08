<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Consts\Success;
use App\Consts\Error;
use App\Consts\Link;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
  public function __construct()
  {
    $this->models = new Article();
    $this->commentModels = new Comment();
  }

  public function index() {
    $data = $this->models->PagerSystem();
    return view('pages/articles/index',['data'=>$data]);
  }

  public function getInsert(){
    return view('pages/articles/insert');
  }

    /**
   * Handle an incoming registration request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */

  public function insert(Request $request) { 
    // $title = $this->inputCheck($_POST["title"]);
    // $content = $this->inputCheck($_POST["content"]);
    $request->validate([
      'title' => ['required', 'string', 'max:255'],
      ]);
    $this->models->insert($request->title, Auth::user()->user_id, $request->content);
    return view('pages/results/finish',['data'=>Success::REGISTER,'link'=>Link::ARTICLES]);
  }  

  public function search(Request $request) {
    $data = $this->models->search($request->input('keyword'));
    return view('pages/articles/search',['data'=>$data]);
  }

  public function detail(Request $request) {
    $data = $this->models->detail($request->id);
    $data["stmt"]=$this->commentModels->create($request->id);
    return view('pages/articles/detail',['data'=>$data,'request'=>$request]);
  }

  
  public function getUpdate(Request $request) {
    $data = $this->models->detail($request->id);
    if($data->user_id === Auth::user()->user_id){
    return view('pages/articles/update',['data'=>$data,'request'=>$request]);
    }else{
      $this->data["msg"] = $this->data["errorresult"];
      require_once ( dirname(__FILE__) . $_ENV["USERS_DIRECTRY"] . "error.php"); 
    }
  }
}