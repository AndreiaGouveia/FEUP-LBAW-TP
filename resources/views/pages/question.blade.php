@extends('layouts.app')

@section('stylesheets')

<link rel="stylesheet" type="text/css" href="{{ asset('css/question.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">

@parent
@endsection

@section('content')

<div class="container mt-5">

    <div class="row">
        <div class="col-md-8">

            <div class="pb-3 mb-1 border-bottom">
                <h2>{{ $question->title }}</h2>

                <div class="description mt-3">
                    <p>{{ $publication->description }}</p>
                </div>

                <div class="row justify-content-between align-items-center mt-4 mb-3 px-0 mx-0">
                    <div class="topics align-items-center">
                        <?php
                        ?>
                    </div>

                    <div class="info row justify-content-end align-items-center mx-0">
                        <?php  ?>
                    </div>

                </div>


                <div class="commentSection collapse" id="commentSectionQuestion">
                    <?php  ?>
                </div>
            </div>

            <div class="responseSection mt-4">

                <h5>{{ $question->answers->count() }} responses</h5>

                <hr class="section-break" />
                <ul class="list-unstyled">
                    @foreach ($question->answers as $answer)
                    @include('partials.answer', ["answer" => $answer->publication, "owner" => $answer->publication->owner])
                    @endforeach

                </ul>
                <form id="response_form">
                    <div class="form-group">
                        @csrf
                        <input type="hidden" id="id_question" name="id_question" value="{{ $question->id_commentable_publication }}">
                        <label for="exampleInputEmail1">A tua Resposta</label>
                        <textarea form="response_form" id="response_text" name="response_text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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