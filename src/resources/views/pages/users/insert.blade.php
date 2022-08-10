@extends('layouts/base')

@section('title', '新規登録')
@section('css')
<link rel="stylesheet" href="{{ asset('css/signUp.css') }}">
@endsection

@section('content')
<div class="form-wrapper">
  <h1>新規会員登録</h1>
  <form method="post" action="{{ url('users/insert') }}">
    @csrf
    <div class="form-item">
      <label for="email"></label>
      <p class="inputform">ログインID：{{$email["email"]}}<p>
      <p class="error_result"></p>
    </div>
    <div class="form-item">
      <label for="password">半角英数10文字以上</label>
      <input type="password" id="pass1" class="inputform" name="pass" required="required" placeholder="パスワード">
      <p class="error_result"></p>
    </div>
    <div class="form-item">
      <label for="password2"></label>
      <input type="password" id="pass2" class="inputform" required="required" placeholder="パスワード再確認">
      <p class="error_result"></p>
    </div>
    <div class="form-item">
      <label for="name">半角英数8文字以上</label>
      <input type="text" name="name" id="nickname" class="inputform" required="required" placeholder="ニックネーム">
      <p class="error_result"></p>
    </div>
    <div class="button-panel">
      <?php echo '<input type="hidden" value="'.$email["email"].'" name="email">'?>
      <input type="submit" class="button" title="Sign In" id="submit" value="登録" disabled>
    </div>
  </form>
</div>
<script src="/js/validation.js"></script>
@endsection