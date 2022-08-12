@extends('layouts/base')

@section('title', '記事検索')
@section('css')
<link rel="stylesheet" href="{{ asset('css/articleList.css') }}">
@endsection

@section('content')
@foreach ( $data as $row ) 
  <div class= 'kiji'><p class ='row row2'>タイトル:{{$row->title}}</p>
  <p class ='row row3'>内容:{{nl2br($row->content)}}</p>
  <p class ='row row4'>投稿者:{{$row->user->name}}</p>
  <p class ='row row5'>投稿日時:{{$row->created_at}}</p>
  <a href='{{ route('articles/detail', $row) }}'>コメント</a>
  </div>
@endforeach
{!! $data->links() !!}
@endsection