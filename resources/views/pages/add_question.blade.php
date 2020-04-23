@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
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
                <input id="inputTopics" class="form-control" placeholder="Tópicos" autofocus="">
            </div>

            <div class="d-flex justify-content-end d-inline">
                <button class="btn btn-secondary mr-2">Cancelar</button>
                <button type="submit" class="btn btn-primary">Adicionar Questão</button>
            </div>

        </div>
    </form>
</div>

@endsection