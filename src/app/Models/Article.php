<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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

  public function put(string $title, string $content, string $id){
    Article::where('id',$id)
    ->update(['title'=>$title,'content'=>$content]);
  }

  public function remove(string $id){
    Article::where('id',$id)->delete();
  }

  public function identification(string $id) :string{
    $data = Article::where('id',$id)->first('user_id');
    return $data;
  }
}
