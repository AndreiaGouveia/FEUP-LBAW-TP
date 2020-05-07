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
            
                @each('partials.basic_activity', $questions, 'question')
            
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