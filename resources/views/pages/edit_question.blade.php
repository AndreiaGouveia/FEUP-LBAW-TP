@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/add_question.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

@endsection

@section('content')

<div class="col-md-7 mx-auto my-5">

    @include('flash::message')

    <h3 class="font-weight-normal mb-3">Editar Questão</h3>
    <hr class="section-break" />

    <form id="edit_question" method="POST" action="{{ route('update.question', [$id]) }}">
        <div class="form-group">
            @csrf
            <!--SUPER DUPER IMPORTANTE-->

            <div class="content mb-4">
                <label for="inputTitle">Titulo</label>
                <input id="inputTitle" name="title" class="form-control" placeholder="Titulo" value="<?php echo $question->title; ?>" required="" autofocus="">
            </div>

            <div class="content mb-4">
                <label for="textAreaDescription">Descrição</label>
                <textarea form="edit_question" id="textAreaDescription" name="description" class="form-control" placeholder="Descrição" required="" autofocus="" rows="6"><?php echo $question->publication->description; ?></textarea>
            </div>

            <div class="content mb-4">
                <label for="inputTopics">Tópicos</label>
                <br>
                @php
                var_dump($locations);
                @endphp

                <select id="inputTopics" class="input-topics" name="tags[]" multiple="multiple">
                @foreach ($locations as $key => $location)
                    @if(in_array($location, $tags))
                     <option value={{$key}} selected="selected">{{$location}}</option>
                     @else
                     <option value={{$key}} >{{$location}}</option>
                     @endif
                @endforeach
                </select>

            </div>

            <div class="d-flex justify-content-end d-inline">
                <button class="btn btn-secondary mr-2">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar Questão</button>
            </div>

        </div>
    </form>
</div>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
    $('.input-topics').select2();
    });
</script>

@endsection