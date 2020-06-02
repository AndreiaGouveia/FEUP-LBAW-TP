<?php

$link_image = ($publication->owner->photo != null) ? $publication->owner->photo->url : null;
?>

@extends('layouts.app')

@section('title')
{{ $question->title }}
@endsection

@section('stylesheets')

<link rel="stylesheet" type="text/css" href="{{ asset('css/question.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">

@parent
@endsection

@section('content')

<div class="container mt-5">

    @include('flash::message')

    <div class="row">
        <div class="main-content col-md-8">
            @include('activities.header_activity', ['memberId' => $publication->owner->id_person, 'name' => $publication->owner->name, "link_profile" => $link_image, 'action' => "", 'actionInBold' => "", "date" => $publication->date, "anonymous" => !$publication->owner->person->visible, "banned" => $publication->owner->person->ban])
            <div class="pb-3 mb-1 border-bottom">
                <h1>{{ $question->title }}</h1>

                <div class="description mt-3">
                    @markdown($publication->description)
                </div>

                <div class="row justify-content-between align-items-center mt-4 mb-3 px-0 mx-0">
                    <div class="topics align-items-center">
                        @foreach ($question->tags as $tag_question)
                        @include('interation.tag', ['tag' => $tag_question->main_tag->name])
                        @endforeach
                    </div>

                    <div class="info row justify-content-end align-items-center mx-0" data-publication-id="{{ $question->id_commentable_publication }}">
                        @include('interation.info_content', ['type' => $question])
                    </div>

                </div>

                <div class="commentSection collapse" id=<?= "commentSection" . $question->id_commentable_publication ?>>
                    @include('partials.comment_section', ['comments' => $question->commentable_publication->comments, 'id_publication' => $question->id_commentable_publication])
                </div>

            </div>

            <div class="responseSection mt-4">

                <h5><span id="number_answers">{{ $question->answers->count() }}</span> respostas</h5>

                <hr class="section-break" />
                <ul class="list-unstyled" id="response_section">
                    @foreach ($question->answers as $answer)
                    @include('partials.answer', ["answer"=> $answer, "publication" => $answer->publication, "owner" => $answer->publication->owner])
                    @endforeach

                </ul>
                <form id="response_form">
                    <div class="form-group">
                        <input type="hidden" id="id_question" name="id_question" value="{{ $question->id_commentable_publication }}">
                        <label for="exampleInputEmail1">A tua Resposta</label>
                        <textarea form="response_form" id="response_text" name="response_text" class="form-control" id="exampleFormControlTextarea1" rows="3" required=""></textarea>
                    </div>
                    <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Responder</button></div>
                </form>
            </div>

        </div>

        <aside class="col-md mb-4">

            <h6>Recomendações</h6>
            <hr class="section-break" />
            <div class="recommendations-tab">
                @foreach ($similar_questions as $similar_question)
                <a class="link-color" href="{{route('show.question', $similar_question->id)}}">
                    <p class="card-text">{{ $similar_question->title }}</p>
                </a>
                @endforeach
            </div>

        </aside>

    </div>
</div>

@endsection