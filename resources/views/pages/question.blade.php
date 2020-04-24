<?php

$link_image = ($publication->owner->photo != null) ? $publication->owner->photo->url : null;
?>

@extends('layouts.app')

@section('stylesheets')

<link rel="stylesheet" type="text/css" href="{{ asset('css/question.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">

@parent
@endsection

@section('content')

<script>
    $('body').on('click', '.btn.active', function(e) {
        e.stopImmediatePropagation();
        e.preventDefault();
        console.log(this, $('input:radio[name="options"]', this));
        $(this).removeClass('active');
        $('input:radio[name="options"]', this).prop('checked', false);
    })
</script>

<div class="container mt-5">

    @include('flash::message')

    <div class="row">
        <div class="col-md-8">
            @include('partials.header_activity', ['idMember' => $publication->owner, 'name' => $publication->owner->name, "link_profile" => $link_image, 'action' => "", 'actionInBold' => "", "date" => $publication->date])
            <div class="pb-3 mb-1 border-bottom">
                <h2>{{ $question->title }}</h2>

                <div class="description mt-3">
                    <p>{{ $publication->description }}</p>
                </div>

                <div class="row justify-content-between align-items-center mt-4 mb-3 px-0 mx-0">
                    <div class="topics align-items-center">
                        @foreach ($question->tags as $tag_question)
                        @include('partials.tag', ['tag' => $tag_question->main_tag->name])
                        @endforeach
                    </div>

                    <div class="info row justify-content-end align-items-center mx-0">
                        @include('partials.info_content', ['commentable_publication' => $question->commentable_publication ])
                    </div>

                </div>

                <div class="commentSection collapse" id=<?= "commentSection" . $question->id_commentable_publication ?>>
                    @include('partials.comment_section', ['comments' => $question->commentable_publication->comments, 'id_publication' => $question->id_commentable_publication])
                </div>


                <div class="commentSection collapse" id="commentSectionQuestion">
                    @include('partials.comment_section', ['comments' => $question->commentable_publication->comments, 'id_publication' => $question->id_commentable_publication])
                </div>
            </div>

            <div class="responseSection mt-4">

                <h5><span id="number_answers">{{ $question->answers->count() }}</span> responses</h5>

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
        <div class="sidebar col-md">

        </div>

    </div>
</div>

@endsection