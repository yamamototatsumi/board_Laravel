<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
  public function index(Request $request, int $id){
    $data = Comment::with('article')
    ->where('article_id', $id)->get();
    return response()->json($data);
  }

  public function insert(Request $request) {
    Comment::create(
      ['article_id'=>$request->article_id,
        'content'=>$request->content,
        'user_id'=>$request->id]);
        return response()->json([
          "message" => "登録完了"
    ], 201);
  }

  public function update(Request $request, Comment $comment) {
    $this->authorize('update', $comment);
    Comment::find($request->id)->fill(['content'=>$request->content])->save();
    return response()->json([
      "message" => "更新完了"
    ], 201);
  }

  public function delete(Request $request, Comment $comment) {
    $this->authorize('update', $comment);
    Comment::find($request->id)->delete();
    return response()->json([
      "message" => "削除完了"
    ], 201);
  }

  
}
