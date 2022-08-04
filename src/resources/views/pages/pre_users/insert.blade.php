@extends('layouts/base')

@section('title', 'マイページ')
@section('css')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('content')
<?php 
echo "<h1>". $data ."</h1>";
echo env('URL')."users/insert?id=".$userId; 
?>
@endsection