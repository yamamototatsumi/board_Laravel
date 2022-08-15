<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Consts\Link;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
  public function index() {
    $json = $this->article->index()->orderby('id','desc')
    ->paginate(Link::MAXVIEW)->toJson(JSON_PRETTY_PRINT);
    $datas = json_decode($json);
    // dd($datas->data[0]);
    // echo $datas->data[0]->title;
    // var_dump($datas->data[0]->title);
    // exit();
    return view('articles/index',['data'=>$datas->data,'count'=>0]);
  }

  public function detail(Request $request, int $id) {
    $articleJson = $this->article->detail($id)->first()->toJson(JSON_PRETTY_PRINT);
    $commentJson = $this->comment->index($id)->get()->toJson(JSON_PRETTY_PRINT);
    // dd($articleJson);
    $datas = json_decode($articleJson,false);
    $comments = json_decode($commentJson);
    // dd($comments);

    return view('articles/detail',['data'=>$datas,'comment'=>$comments,'request'=>$request,]);
    // 'user_id'=>Auth::user()->user_id
  }
}
