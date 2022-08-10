<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'title', 'content'];
  
    public function insert(string $title, string $id,string $content){
      DB::transaction(function () use ($title, $id, $content) {
      Article::create(['title'=>$title,'content'=>$content,'user_id'=>$id,]);
      });
    }

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

  public function detail(string $id) :object{
    $data = Article::join('users','articles.user_id', '=', 'users.user_id')
          ->where('articles.id', $id)
          ->first();
    return $data;
  }


  public function put(object $request){
    DB::transaction(function () use ($request) {
      Article::find($request->id)
      ->fill($request->all())->save();
    });
  }

  public function remove(string $id){
    DB::transaction(function () use ($id) {
      Article::find($id)->delete();
    });
  }

  public function identification(string $id) :string{
    $data = Article::where('id',$id)->first('user_id');
    return $data;
  }

  public function month() :int{
    $data=Article::whereYear('created_at', date('Y-M'))
    ->get()
    ->groupBy('created_at',date('Y-M'))
    ->count();
    return $data;
  }
}
