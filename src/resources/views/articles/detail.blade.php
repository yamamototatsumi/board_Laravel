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
  <p class ='row row4'>投稿者:{{$data->user->name}}</p>
  <p class ='row row5'>投稿日時:{{$data->created_at}}</p>
  @if($user_id === $data->user_id)
    <form method="POST" action="{{route('articles/update')}}">
      @csrf
      <input type="hidden" name="articleToken" value="{{$data->user_id}}">
      <input type="hidden" name="id" value="{{$data->id}}">
      <input type="submit" value="編集">
    </form>
    
    <form method="POST" action="{{route('articles/delete')}}">
      @csrf
      @method('DELETE')
      <input type="hidden" name="articleToken" value="{{$data->user_id}}">
      <input type="hidden" name="id" value="{{$data->id}}">
      <input type="submit" value="削除">
    </form>
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
    <p class ='row row4'>投稿者:{{$row->article->user->name}}</p>
    <p class ='row row5'>投稿日時":{{$row->created_at}}</p>
    @if(Auth::user()->user_id === $row['user_id'])

    <form method="POST" action="{{route('comments/update')}}">
      @csrf
      <input type="hidden" name="commentToken" value="{{$row->user_id}}">
      <input type="hidden" name="id" value="{{$row->id}}">
      <input type="submit" value="編集">
    </form>

    <form method="POST" action="{{route('comments/delete')}}">
      @csrf
      @method('DELETE')
      <input type="hidden" name="commentToken" value="{{$row->user_id}}">
      <input type="hidden" name="id" value="{{$row->id}}">
      <input type="submit" value="編集">
    </form>

    @endif
    </div>
@endforeach
</div>

@endsection







