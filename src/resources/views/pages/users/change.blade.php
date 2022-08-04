@extends('layouts/base')

@section('title', 'ユーザー情報変更完了')
@section('css')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<?php
echo $this->data["result"];
?>
@endsection