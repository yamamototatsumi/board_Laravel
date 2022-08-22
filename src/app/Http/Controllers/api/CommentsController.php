<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Symfony\Component\HttpFoundation\Response;


class CommentsController extends Controller
{
  public function index(Request $request, int $id){
    $data = Comment::with('article')
    ->where('article_id', $id)->get();
    return response()->json($data);
  }

  public function store(Request $request) {
    $attributes = $request->only(['article_id', 'content', 'user_id']);
    Comment::create($attributes);
    $comment = Comment::first();
    return response()->json(["message" => $comment], Response::HTTP_CREATED);
  }

  public function update(Request $request, Comment $comment) {
    $this->authorize('update', $comment);
    $comment = Comment::find($request->id);
    $comment->fill(['content'=>$request->content])->save();
    return response()->json(["message" => "更新完了"], 201);
  }

  public function destroy(Request $request, Comment $comment) {
    $this->authorize('update', $comment);
    $comment = Comment::find($request->id);
    $comment->delete();
    return response()->json(["message" => "削除完了"], 201);
  }

  
}
