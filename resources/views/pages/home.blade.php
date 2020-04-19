@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
@endsection


@section('content')

<div class="welcome d-flex justify-content-between align-items-center">
    <div class="flex-fill ml-5">
        <h1 class="text-center">Bem-Vindo ao Papagaio!</h1>
        <h2 class="text-center mt-3 d-none d-xl-block">Entre no mundo do conhecimento Animal.</h2>
    </div>
    <img src="..\images\logo.png" class="welcomeLogo" alt="logoBig">
</div>


@endsection