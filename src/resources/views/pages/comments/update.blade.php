@extends('layouts/base')

@section('title', 'コメント編集')
@section('css')
<link rel="stylesheet" href="{{ asset('css/articleEdit.css') }}">
@endsection

@section('content')
<div class="articleBody">
  <div class="articleOld"> 
    <p>現在のコメント</p>
    {{nl2br($data->content)}}
  </div>
  <div class="hensyuu">
    <form action={{ route('comments/update') }} method="POST">
      @csrf
      @method('PATCH')
      <label>新しいコメント:</label>
      <textarea name="main" id="main" required='required'></textarea><br>
      <input type='hidden' name='id' value='{{$request->id}}'>
      <input type="submit" id="submit" value="編集する">
    </form>
  </div>
@endsection