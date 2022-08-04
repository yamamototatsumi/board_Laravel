@extends('layouts/base')

@section('title', 'コメント編集')
@section('css')
<link rel="stylesheet" href="{{ asset('css/articleEdit.css') }}">
@endsection

@section('content')
<div class="articleBody">
  <div class="articleOld"> 
    <p>現在のコメント</p>
    <?php echo nl2br($this->data['content']);?>
  </div>
  <div class="hensyuu">
    <form action="updateComment" method="POST">
      <label>新しいコメント:</label>
      <textarea name="main" id="main" required='required'></textarea><br>
      <?php echo "<input type='hidden' name='id' value='".$_GET["id"]."'>"; ?>
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']) ?>">
      <input type="submit" id="submit" value="編集する">
    </form>
  </div>
@endsection