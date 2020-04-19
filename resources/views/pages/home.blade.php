@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection


@section('content')

<div class="welcome d-flex justify-content-between align-items-center">
    <div class="flex-fill ml-5">
        <h1 class="text-center">Bem-Vindo ao Papagaio!</h1>
        <h2 class="text-center mt-3 d-none d-xl-block">Entre no mundo do conhecimento Animal.</h2>
    </div>
    <img src="..\images\logo.png" class="welcomeLogo" alt="logoBig">
</div>

<div class="container main-page-container mt-5">
    <div class="row flex-column-reverse flex-lg-row">
        <div class="col-md-8">

            <div>
                <h2 class="font-weight-normal mb-3">Questões Populares </h2>

                @each('partials.basic_activity', $questions, 'question')
            </div>

        </div>
        <div class="col-md mb-4"> <?php /* Draw topics */ ?></div>
    </div>
</div>


@endsection