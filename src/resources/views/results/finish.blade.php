@extends('layouts/base')

@section('title', 'マイページ')
@section('css')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<h1>{{$data}}</h1> <br>
<a href ={{$link}}>戻る</a>
@endsection