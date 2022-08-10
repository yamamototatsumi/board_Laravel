@extends('layouts/base')

@section('title', '記事詳細')
@section('css')
<link rel="stylesheet" href="{{ asset('css/articleList.css') }}">
@endsection

@section('content')

<div class="articleBody">

  <p class='p'>投稿詳細</p>
  <div class= 'kiji'><p class ='row row2'>タイトル:{{$data->title}}</p>
  <p class ='row row3'>内容:{{nl2br($data->content)}}</p>
  <p class ='row row4'>投稿者:{{$data->name}}</p>
  <p class ='row row5'>投稿日時:{{$data->created_at}}</p>
  @if(Auth::user()->user_id === $data->user_id)
    <a href='update?id={{$request->id}}'>編集</a>
    <a href='delete?id={{$request->id}}'>削除</a>
  @endif
  </div>
</div>
<div class="comment">
<p class="p">コメントする</p>
<form method="POST" action={{ route('comments/insert') }}>
  @csrf
<textarea name="main" id="main" required></textarea>
<div class="AA"><input type='hidden' name='id' value={{$request->id}}></div>
<input type="submit" value="コメントする" id="submit">
</form>
</div>
<div class="commentList">

@foreach ($comment as $row) 
    <div class= 'kiji'><p class ='row row2'>コメント:{{nl2br($row->content)}} </p>
    <p class ='row row4'>投稿者:{{$row->name}}</p>
    <p class ='row row5'>投稿日時":{{$row->created_at}}</p>
    @if(Auth::user()->user_id === $row['user_id'])
      <a href='../comments/update?id={{$row->id}}'>編集</a>
      <a href='/../comments/delete?id={{$row->id}}'>削除</a>
    @endif
    </div>
@endforeach
</div>

@endsection







