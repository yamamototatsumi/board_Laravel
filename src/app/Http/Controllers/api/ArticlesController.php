<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends Controller
{
    public function index(){
      $data = Article::get();
      return response()->json(["message" => $data],Response::HTTP_OK);
    }

    public function detail(Request $request, int $id)
    {
      $data = Article::find($id);
      return response()->json(["message" => $data],Response::HTTP_OK);
    }

    public function store(Request $request) {
      $attributes = $request->only(['title', 'content', 'user_id']);
      Article::create($attributes);
      $articles = Article::orderby('desc')->first();
      return response()->json(["message" => $articles], Response::HTTP_CREATED);
    }

    public function update(Request $request, Article $article) {
      $this->authorize('update', $article);
      $article = Article::find($request->id);
      $article->fill($request->all())->save();
      return response()->json(["message" => "更新完了"], Response::HTTP_CREATED);
  }


    public function destroy(Request $request, Article $article) {
      $this->authorize('update', $article);
      $article = Article::find($request->id);
      $article->delete();
      return response()->json(["message" => $article], Response::HTTP_OK);
    }
}
