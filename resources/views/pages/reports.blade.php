@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">

@endsection

@section('content')

<div class="col-md-7 mx-auto">
    <div class=" mt-5">
        <h1 class="font-weight-normal mb-3">Reported Content</h1>
        <hr class="section-break" />

    </div>

    <div class="mt-5" id="about-text">

        <div class="row">
            <div class="col">
                Publication
            </div>
            <div class="col-2">
                Date
            </div>
            <div class="col-3">
                Author
            </div>
        </div>

        @each('partials.reported_question', $questions, 'question')
        @each('partials.reported_answer', $answers, 'answer')
        @each('partials.reported_comment', $comments, 'comment')

    </div>
</div>


@endsection