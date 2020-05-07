<?php

use App\Tag;

$temp = Tag::get();

$locations = array();
array_push($locations, ' ');

foreach ($temp as &$value) {
    $new_location_array = array();

    if (isset($value->name))
        array_push($new_location_array, $value->city);

    array_push($locations, $value->name);
}

?>

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

    <h3 class="font-weight-normal mb-3">Adicionar Questão</h3>
    <hr class="section-break" />

    <form id="add_question" method="POST" action="{{ route('store.question') }}">
        <div class="form-group">
            @csrf
            <!--SUPER DUPER IMPORTANTE-->

            <div class="content mb-4">
                <label for="inputTitle">Titulo</label>
                <input id="inputTitle" name="title" class="form-control" placeholder="Titulo" value="{{ old('inputTitle') }}" required="" autofocus="">
            </div>

            <div class="content mb-4">
                <label for="textAreaDescription">Descrição</label>
                <textarea form="add_question" id="textAreaDescription" name="description" value="{{ old('description') }}" class="form-control" placeholder="Descrição" required="" autofocus="" rows="6"></textarea>
            </div>

            <div class="content mb-4">
                <label for="inputTopics">Tópicos</label>
                <br>

                <select id="inputTopics" class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                    <script>
                        var myArray = <?php echo json_encode($locations); ?>;
                        for (i = 0; i < myArray.length; i++) {
                            document.write('<option value="' + i + '">' + myArray[i] + '</option>');
                        }
                    </script>
                </select>

            </div>

            <div class="d-flex justify-content-end d-inline">
                <button class="btn btn-secondary mr-2">Cancelar</button>
                <button type="submit" class="btn btn-primary">Adicionar Questão</button>
            </div>

        </div>
    </form>
</div>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>

@endsection