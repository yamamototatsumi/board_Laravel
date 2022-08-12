<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'article_id', 'content'];

    public function article() {
      return $this->belongsTo(Article::class);
    }

    public function insert(string $content, string $article_id, string $id) {
      Comment::create(['article_id'=>$article_id,'content'=>$content,'user_id'=>$id]);
    }

    public function index(string $id) :object{
      $data = Comment::with('article')
              ->where('comments.article_id', $id);
        return $data;
    }

    public function detail(string $id) :object{
      $data = Comment::with('article')->where('id', $id);
      return $data;
    }

    public function put(string $content, string $id) {
      Comment::find($id)
      ->fill(['content'=>$content])->save();
    }

    public function remove(string $id) {
      Comment::find($id)->delete();
    }
}