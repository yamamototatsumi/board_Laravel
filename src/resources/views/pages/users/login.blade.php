@extends('layouts/base')

@section('title', 'ログインページ')
@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="form-wrapper">
    <h1>ログイン</h1>
    <form action="login" method="post">
      @csrf
      <div class="form-item">
        <label for="email"></label>
        <input type="email" name="email" required="required" placeholder="ログインID">
      </div>
      <div class="form-item">
        <label for="password"></label>
        <input type="password" name="pass" required="required" placeholder="パスワード">
      </div>
      <div class="button-panel">
        <input type="submit" class="button" title="Sign In" value="ログイン" >
      </div>
    </form>
    <div class="form-footer">
      <p><a href="/preUsers/signUp">アカウント新規作成</a></p>
      <p><a href="#">パスワードをお忘れですか？</a></p>
    </div>
  </div>
</div>
@endsection