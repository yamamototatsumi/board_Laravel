<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'article_id', 'content'];

    public function insert(string $content, string $article_id, string $id) {
      DB::transaction(function () use ($content, $article_id ,$id) {
        Comment::create(['article_id'=>$article_id,'content'=>$content,'user_id'=>$id]);
      });
    }

    public function index(string $id) :object{
      $data = Comment::select('comments.id as id' ,'users.name', 'comments.content',
      'comments.user_id','comments.created_at as created_at','comments.deleted_at as deleted_at')
              ->join('users','users.user_id', '=', 'comments.user_id')
              ->where('comments.article_id', $id)
              ->get();
        return $data;
    }

    public function detail(string $id) :object{
      $data = Comment::where('id', $id)
            ->first();
      return $data;
    }

    public function put(string $content, string $id){
      DB::transaction(function () use ($content,$id) {
        Comment::find($id)
        ->fill(['content'=>$content])->save();
      });
    }



    public function remove(string $id){
      DB::transaction(function () use ($id) {
        Comment::find($id)->delete();
      });
    }

}