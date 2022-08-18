<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function index()
    {
        $datas = Article::get();
        return response()->json($datas);
    }

    public function detail(Request $request, int $id)
    {
        $data = Article::find($id);
        return response()->json($data);
    }

    public function insert(Request $request) {
      $article = new Article();
      $article->title = $request->title;
      $article->content = $request->content;
      $article->user_id = $request->user_id;
      $article->save();
      return response()->json([
        "message" => "登録完了"
  ], 201);
    }

    public function update(Request $request, Article $article) {
      $this->authorize('update', $article);
      Article::find($request->id)->fill($request->all())->save();
      return response()->json([
        "message" => "更新完了"
  ], 201);
  }


    public function delete(Request $request, Article $article) {
      $this->authorize('update', $article);
      Article::find($request->id)->delete();
      return response()->json([
        "message" => "削除完了"
      ], 201);
    }
}
