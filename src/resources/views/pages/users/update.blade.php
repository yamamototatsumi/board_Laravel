@extends('layouts/base')

@section('title', 'ユーザー情報変更')
@section('css')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
@if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li><h3><font color='red'>{{ $error }}</font></h3></li>
        @endforeach
    </ul>
@endif


<form action={{ route('users/update') }} method="POST">
  @csrf
  @method('PATCH')
  <h1>ユーザー情報変更</h1>
  <p>現在のユーザー名</p> 
  <p>{{$data}}</p> 

  <p>新しいユーザー名:</p>
  <input type='text' id="newname" name='name' class="ca_inputform"><br>
  <p class="change_acount_error_result">半角英数8文字以上</p>
  <p>現在のパスワード</p>
  <input type= "password" id="oldpass" name="oldpass" class="ca_inputform"><br>
  <p class="change_acount_error_result">半角英数10文字以上</p>
  <p>新しいパスワード</p>
  <input type= "password" id="newpass" name="pass" class="ca_inputform"><br>
  <p class="change_acount_error_result">半角英数10文字以上</p>
  <input type="submit" value="変更する" id="change_acount_submit" disabled>
</form>
<script src="/js/changeAcount.js"></script>
@endsection