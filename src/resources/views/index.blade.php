@extends('layouts/base')

@section('title', '掲示板サイト')
@section('css')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<div class="mainarea container">

  <a href= {{ route('login') }} class="btn btn-flat"><span>ログイン</span></a><br><br><br>
  <a href= {{ route('dashboard') }} class="btn btn-flat"><span>会員登録</span></a><br><br><br>
  <a href= {{ route('articles/index') }} class="btn btn-flat"><span>投稿一覧</span></a><br><br><br>
  <a href= {{ route('articles/insert') }} class="btn btn-flat"><span>新規投稿</span></a>

  <p class="registerCount">今月の登録者数: {{$user}}人</p>
  <p class="registerCount">今月の投稿記事者数: {{$article}} 件</p>
@endsection

