@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/add_question.css') }}">

@endsection

@section('content')

<div class="col-md-7 mx-auto my-5">

    @include('flash::message')

    <h3 class="font-weight-normal mb-3">Editar Sobre Nós</h3>
    <hr class="section-break" />

    <form id="add_question" method="POST" action="{{ route('about.edit') }}">
        <div class="form-group">
            @csrf
            <!--SUPER DUPER IMPORTANTE-->

            <div class="content mb-4">
                <label for="textAreaDescription">Descrição</label>
                <textarea form="add_question" id="textAreaDescription" name="description" value="{{ old('description') }}" class="form-control" placeholder="Descrição" autofocus="" rows="6"></textarea>
            </div>

            <div class="d-flex justify-content-end d-inline">
                <button class="btn btn-secondary mr-2">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>

            <script>
                var easyMDE = new EasyMDE({
                    element: document.getElementById('textAreaDescription'),
                    initialValue: <?= json_encode($description) ?>,
                    renderingConfig: {
                        singleLineBreaks: true,
                        sanitizerFunction: function(renderedHTML) {
                            return DOMPurify.sanitize(renderedHTML)
                        },
                    },
                    lineWrapping: false,
                });
            </script>

        </div>
    </form>
</div>

@endsection