@extends('layouts.app')

@section('title')
Conteúdo Reportado
@endsection

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/settings.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/question.min.css') }}">

@endsection

@section('javascript')

<script src={{ asset('js/manage_report.js') }} defer>
  </script>

@endsection

@section('content')

<div class="col-md-7 mx-auto">
    <div class=" mt-5">
        <h1 class="font-weight-normal mb-3">Conteúdo Reportado</h1>
        <hr class="section-break" />

        <div class="row container justify-content-between mb-4">
            <div class="list-group list-group-horizontal mb-2" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active py-2" id="list-questions-list" data-toggle="list" href="#list-questions" role="tab" aria-controls="questions">Perguntas</a>
                <a class="list-group-item list-group-item-action py-2" id="list-answers-list" data-toggle="list" href="#list-answers" role="tab" aria-controls="answers">Respostas</a>
                <a class="list-group-item list-group-item-action py-2" id="list-comments-list" data-toggle="list" href="#list-comments" role="tab" aria-controls="comments">Comentários</a>
            </div>

            <div id="nav-tabContent" class="tab-content mt-4">

                <div class="tab-pane fade show active table-responsive" id="list-questions" role="tabpanel" aria-labelledby="list-questions-list">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Publicação</th>
                                <th scope="col" class="col-3">Motivo</th>
                                <th scope="col" class="col-1">Resolvido?</th>
                            </tr>
                        </thead>
                        <tbody>@each('partials.reported_question', $questions, 'question')</tbody>
                    </table>
                </div>


                <div class="tab-pane fade table-responsive" id="list-answers" role="tabpanel" aria-labelledby="list-answers-list">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Publicação</th>
                                <th scope="col" class="col-3">Motivo</th>
                                <th scope="col" class="col-1">Resolvido?</th>
                            </tr>
                        </thead>
                        <tbody>@each('partials.reported_answer', $answers, 'answer')</tbody>
                    </table>
                </div>

                <div class="tab-pane fade table-responsive" id="list-comments" role="tabpanel" aria-labelledby="list-comments-list">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Publicação</th>
                                <th scope="col" class="col-3">Motivo</th>
                                <th scope="col" class="col-1">Resolvido?</th>
                            </tr>
                        </thead>
                        <tbody>@each('partials.reported_comment', $comments, 'comment')</tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection