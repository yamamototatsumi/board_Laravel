@extends('layouts/base')

@section('title', 'エラー')
@section('css')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<?php
echo $data ."<br>";
echo "<a href =".$link.">戻る</a>";
?>
@endsection