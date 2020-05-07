@extends('layouts.app')

@section('stylesheets')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/settings.css') }}">
@endsection


@section('content')

<div class="container mt-5">
    <div class="row flex-column-reverse flex-lg-row">
        <div class="col-md-8">

            <div class="mb-3">
                <h2 class="font-weight-normal text-secondary d-inline">Resultados de Pesquisa para </h2>
                <h2 class="d-inline"><?= $search ?></h2>
            </div>

            <div class="row container justify-content-between mb-4">
                <div class="list-group list-group-horizontal mb-2">
                    <a class="list-group-item py-2 active" href="{{ route('search', $search) }}">Perguntas</a>
                    <a class="list-group-item py-2" href="{{ route('search.topic', $search) }}">Tópicos</a>
                </div>
                <select class="custom-select">
                    <option selected>Revelante</option>
                    <option value="1">Recente</option>
                    <option value="2">Mais Votados</option>
                    <option value="3">Menos Votados</option>
                </select>
            </div>

            <div>
                @each('partials.basic_activity', $questions, 'question')
            </div>

        </div>
        <div class="col-md mb-4">
            <h6>Tópicos Populares</h6>
            <hr class="section-break" />
            @foreach ($popular_tags as $tag)
            @include('partials.tag', ["tag" => $tag->name])
            @endforeach
        </div>
    </div>
</div>


@endsection