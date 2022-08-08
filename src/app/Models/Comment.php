<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'content'];

    public function insert($content, $article_id, $id) {
      var_dump($article_id);
      var_dump($content);
      var_dump($id);
      Comment::create(['content'=>$content,'user_id'=>$id]);
      //なぜか入らん
    }

    public function create($id){
      $data = Comment::select('comments.id as id' ,'users.name', 'comments.content',
      'comments.user_id','comments.created_at as created_at','comments.deleted_at as deleted_at')
              ->join('users','users.user_id', '=', 'comments.user_id')
              ->where('comments.id', $id)
              ->get();
        return $data;
    }

}