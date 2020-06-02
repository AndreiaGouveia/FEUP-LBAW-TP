@extends('layouts.app')

@section('title')
Editar Comentário
@endsection

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

    <h3 class="font-weight-normal mb-3">Editar Resposta</h3>
    <hr class="section-break" />

    <form id="edit_comment" method="POST" action="{{ route('update.comment', [$id]) }}">
        <div class="form-group">
            @csrf
            <!--SUPER DUPER IMPORTANTE-->

            <div class="content mb-4">
                <label for="textAreaDescription">Descrição</label>
                <textarea form="edit_answer" id="textAreaDescription" name="description" class="form-control" placeholder="Descrição" required="" autofocus="" rows="6"><?php echo $comment->publication->description; ?></textarea>
            </div>



            <div class="d-flex justify-content-end d-inline">
                <button class="btn btn-secondary mr-2">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar Comentário</button>
            </div>

        </div>
    </form>
</div>

@endsection