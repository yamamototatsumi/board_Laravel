<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'content','created_at'];
  
    public function insert(string $title, $id, string $content){
      $id='562cfaf7-ed1b-475c-8049-8c640658fde7';
      Article::create(['title'=>$title,'content'=>$content,'user_id'=>$id,]);
    }

    public function pageCount() :int{
      $count = Article::where('deleted_at', NULL)->get()->count();
      return $count;
  }

  public function pagerSystem() :object
  {
    $data = Article::join('users','articles.user_id', '=', 'users.user_id')
    ->orderBy('articles.id', 'DESC')
    ->paginate(10);
      return $data;
  }

  public function search(string $keyword) :object
  {
    $data = Article::join('users','articles.user_id', '=', 'users.user_id')
          ->where('title', 'like', '%'.$keyword.'%')
          ->orwhere('content', 'like', '%'.$keyword.'%')
          ->paginate(10);
      return $data;
  }

}
