@extends('layouts/base')

@section('title', 'マイページ')
@section('css')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="mainarea">
  <a href="" class="btn btn-flat"><span> <?php echo $data["name"]?> </span></a><br><br><br>
  <a href="update" class="btn btn-flat"><span>情報変更</span></a><br><br><br>
  <a href="../articles/index"  class="btn btn-flat"><span>投稿一覧</span></a><br><br><br>
  <a href="../articles/insert" class="btn btn-flat"><span>新規投稿</span></a>
  <p class="registerCount">今月の登録者数: php echo $data["usercount"] ?>人</p>
  <p class="registerCount">今月の投稿記事者数: php echo $data["articlecount"] ?>件</p>
</div>
@endsection