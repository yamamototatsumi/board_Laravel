@extends('layouts/base')

@section('title', ' 記事編集')
@section('css')
<link rel="stylesheet" href="{{ asset('css/articleEdit.css') }}">
@endsection

@section('content')
<div class="articleBody">
  <div class="articleOld"> 
    <p>タイトル</p>
    <p><?php echo "<p class='p1'>".$this->data['title']."</p>";?></p><br>
    <?php echo nl2br($this->data['content']);?>
  </div>
  <div class="hensyuu">
    <form action="updateArticle" method="POST">
      <label>タイトル：</label>
      <input type="text" name="title" id="title" class="articleform"><br>
      <label>　　内容:</label>
      <textarea name="content" id="main" class="articleform"></textarea><br>
      <?php echo "<input type='hidden' name=id value=".$_GET['id'].">"; ?>
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']) ?>"></input>
      <input type="submit" value="編集する" id="submit" disabled>
    </form>
  </div>
  <script src="/js/articleedit.js"></script>
@endsection