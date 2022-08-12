<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Comment;

class Article extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $dates = ['deleted_at'];
  protected $fillable = ['user_id', 'title', 'content'];

  public function comments() {
    return $this->hasMany(Comment::class);
  }

  public function user() {
    return $this->belongsTo(User::class, 'user_id', 'user_id');
  }
  
  public function insert(string $title, string $id,string $content) {
    Article::create(['title'=>$title,'content'=>$content,'user_id'=>$id,]);
  }

  public function index() :object {
    $data = Article::with('user');
    return $data;
  }

  public function search($keyword) {
    //期間絞っての検索などだとより有効そう
    $data = Article::query();
    $data->when($keyword, function($data, $keyword) { 
        $data->where('title', 'like', '%'.$keyword.'%')
        ->orwhere('content', 'like', '%'.$keyword.'%');
    });
    return $data;
  }

  public function detail($id) {
    $datas = Article::with('user')->where('id',$id);
    return $datas;
  }


  public function put(object $request) {
    Article::find($request->id)
    ->fill($request->all())->save();
  }

  public function remove(string $id){
    Article::find($id)->delete();
  }

  public function scopeMonth($query,$date) {
    return $query->whereYear('created_at', $date);
  }
}
