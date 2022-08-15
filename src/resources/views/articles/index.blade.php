@extends('layouts/base')

@section('title', '記事')
@section('css')
<link rel="stylesheet" href="{{ asset('css/articleList.css') }}">
@endsection

@section('content')
<div class="articleBody">
  <form action="{{ route('articles/search') }}"method="post">
    @csrf
    <h3>記事の検索</h3>
    <label>検索キーワード:</label>
    <input type="text" name="keyword" id="keyword" >
    <input type="submit" name="submit" id="submit" value="検索">
  </form>
  <ul>

    @foreach ( $data as $row ) 
      <div class= 'kiji'><p class ='row row2'>タイトル:{{$row->title}}</p>
      <p class ='row row3'>内容:{{nl2br($row->content)}}</p>
      <p class ='row row4'>投稿者:{{$row->user->name}}</p>
      <p class ='row row5'>投稿日時:{{$row->created_at}}</p>
      <a href='{{ route('api/articles/detail', $row->id) }}' >コメント</a>
      </div>
  @endforeach
  </ul>
  {{-- {{ $data->links()}} --}}
@endsection