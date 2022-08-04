@extends('layouts/base')

@section('title', '記事投稿')
@section('css')
<link rel="stylesheet" href="{{ asset('css/poststyles.css') }}">
@endsection

@section('content')
<h1>新規投稿</h1>
<form id="postform" action="insert" method="POST">
  @csrf
  <div class="group">
    <input id="text3" type="text" name="title" id="title" class="postform" placeholder="タイトルを入力" required="required">
    <div class="text_underline"></div>
  </div>
<textarea class="txt postform" id="main" name="content" placeholder="本文を入力" required="required"></textarea>
<input type="submit"  value="投稿" class="button" id="submit">
</form>
@endsection