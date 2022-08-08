<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'content'];
  
    public function insert(string $title, $id, string $content){
      Article::create(['title'=>$title,'content'=>$content,'user_id'=>$id,]);
    }

  //   public function pageCount() :int{
  //     $count = Article::where('deleted_at', NULL)->get()->count();
  //     return $count;
  // }

  public function pagerSystem() :object
  {
    $data = Article::select('articles.id as id' ,'users.name', 'articles.title' , 'articles.content',
    'articles.user_id','articles.created_at as created_at','articles.deleted_at as deleted_at')
    ->join('users','articles.user_id', '=', 'users.user_id')
    ->orderBy('articles.id', 'DESC')
    ->paginate(10);
    return $data;
  }

  public function search(string $keyword) :object
  {
    $data = Article::select('articles.id as id' ,'users.name', 'articles.title' , 'articles.content',
    'articles.user_id','articles.created_at as created_at','articles.deleted_at as deleted_at')
          ->join('users','articles.user_id', '=', 'users.user_id')
          ->where('title', 'like', '%'.$keyword.'%')
          ->orwhere('content', 'like', '%'.$keyword.'%')
          ->paginate(10);
      return $data;
  }

  public function detail($id) {
    $data = Article::join('users','articles.user_id', '=', 'users.user_id')
          ->where('articles.id', $id)
          ->first();
    return $data;
  }

}
