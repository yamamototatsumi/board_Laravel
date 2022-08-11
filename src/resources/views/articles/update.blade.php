@extends('layouts/base')

@section('title', ' 記事編集')
@section('css')
<link rel="stylesheet" href="{{ asset('css/articleEdit.css') }}">
@endsection

@section('content')
<div class="articleBody">
  <div class="articleOld"> 
    <p>タイトル</p>
    <p class='p1'>{{$data->title}}</p><br>
    <p>{{nl2br($data->content)}}</p>
  </div>
  <div class="hensyuu">
    <form action={{ route('articles') }} method="POST">
      @csrf
      @method('PATCH')
      <label>タイトル：</label>
      <input type="text" name="title" id="title" class="articleform"><br>
      <label>　　内容:</label>
      <textarea name="content" id="main" class="articleform"></textarea><br>
      <?php echo "<input type='hidden' name = id value=".$data->id.">"; ?>
      <input type="submit" value="編集する" id="submit" disabled>
    </form>
  </div>
  <script src="/js/articleedit.js"></script>
@endsection