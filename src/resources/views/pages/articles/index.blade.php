@extends('layouts/base')

@section('title', '記事')
@section('css')
<link rel="stylesheet" href="{{ asset('css/articleList.css') }}">
@endsection

@section('content')
<div class="articleBody">
  <form action="search" method="post">
    @csrf
    <h3>記事の検索</h3>
    <label>検索キーワード:</label>
    <input type="text" name="keyword" id="keyword" required="required">
    <input type="submit" name="submit" id="submit" value="検索">
  </form>
  <ul>
    @foreach ( $data as $row ) 
    {{-- @if(!(isset($row->deleted_at))) --}}
      <div class= 'kiji'><p class ='row row2'>タイトル:{{$row->title}}</p>
      <p class ='row row3'>内容:{{nl2br($row->content)}}</p>
      <p class ='row row4'>投稿者:{{$row->name}}</p>
      <p class ='row row5'>投稿日時:{{$row->created_at}}</p>
      <a href='detail?id={{$row->id}}' >コメント</a>
      </div>
    {{-- @endif --}}
  @endforeach
  </ul>
  {!! $data->links() !!}
@endsection