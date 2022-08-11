
@extends('layouts/base')

@section('title', 'ログアウト')
@section('css')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<p>ログアウトしました。</p>
<a href="../index">トップページへ</a>
@endsection