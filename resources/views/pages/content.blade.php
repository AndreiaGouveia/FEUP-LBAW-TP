@extends('layouts.app')

@section('title')
O meu conteúdo
@endsection

@section('stylesheets')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/search.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/settings.min.css') }}">
@endsection


@section('content')

<div class="col-md-7 mx-auto mt-5">
    <div class="wrap-container row flex-lg-row mx-2">
        <div class="mb-3">
            <h2 class="font-weight-normal d-inline">O meu conteúdo </h2>
        </div>

        <div class="row container justify-content-between mb-4 pr-0">
            <div class="list-group list-group-horizontal overflow-auto flex-fill mb-2" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active py-2" id="list-questions-list" data-toggle="list" href="#list-questions" role="tab" aria-controls="questions">Perguntas</a>
                <a class="list-group-item list-group-item-action py-2" id="list-responses-list" data-toggle="list" href="#list-responses" role="tab" aria-controls="responses">Respostas</a>
                <a class="list-group-item list-group-item-action py-2" id="list-comments-list" data-toggle="list" href="#list-comments" role="tab" aria-controls="comments">Comentários</a>
            </div>
        </div>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-questions" role="tabpanel" aria-labelledby="list-questions-list">
                @each('activities.question_activity', $questions, 'question')
            </div>
            <div class="tab-pane fade" id="list-responses" role="tabpanel" aria-labelledby="list-responses-list">
                @each('activities.answer_activity', $answers, 'answer')
            </div>
            <div class="tab-pane fade" id="list-comments" role="tabpanel" aria-labelledby="list-comments-list">
                @each('activities.comment_activity', $comments, 'comment')
            </div>
        </div>
    </div>
</div>

@endsection