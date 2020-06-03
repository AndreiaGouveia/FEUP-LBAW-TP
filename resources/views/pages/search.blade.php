<?php

use App\Tag;


$temp = Tag::get();

$tags_ = array();
array_push($tags_, ' ');

foreach ($temp as &$value) {

    array_push($tags_, $value->name);
}

?>


@extends('layouts.app')

@section('title')
{{ $search . " - Pesquisa" }}
@endsection

@section('stylesheets')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/settings.css') }}">
@endsection

@section('javascript')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endsection

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<div class="container mt-5">
    <div class="row flex-column-reverse flex-lg-row">
        <div class="main-content col-md-8">

            <div class="mb-3">
                <h2 class="font-weight-normal text-secondary d-inline">Resultados de Pesquisa para </h2>
                <h2 class="d-inline">{{ $search }}</h2>
            </div>

            <div class="row container justify-content-between mb-4">
                <div class="list-group list-group-horizontal mb-2" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active py-2" id="list-questions-list" data-toggle="list" href="#list-questions" role="tab" aria-controls="questions">Perguntas</a>
                    <a class="list-group-item list-group-item-action py-2" id="list-topics-list" data-toggle="list" href="#list-topics" role="tab" aria-controls="topics">Tópicos</a>
                </div>
                <select name="filter" class="custom-select" form="filterform" onchange="this.form.submit();">
                    <option value="relevant" <?php if($filter == "relevant") echo "selected" ?> >Relevante</option>
                    <option value="recent" <?php if($filter == "recent") echo "selected" ?>>Recente</option>
                    <option value="mostLiked" <?php if($filter == "mostLiked") echo "selected" ?> >Mais Gostados</option>
                    <option value="leastLiked" <?php if($filter == "leastLiked") echo "selected" ?>>Menos Gostados</option>
                </select>
            </div>

            {{$filter}}

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-questions" role="tabpanel" aria-labelledby="list-questions-list">
                    @each('activities.basic_activity', $questions, 'question')
                    {{ $questions->links() }}

                </div>

                <div class="tab-pane fade" id="list-topics" role="tabpanel" aria-labelledby="list-topics-list">
                    <div class="container mt-5">
                        <div class="row flex-column-reverse flex-lg-row">
                            <div class="col">

                                @foreach ($topics as $tag)
                                <div class="py-3 px-4 border-top">
                                    <a class="btn btn-secondary" href="{{ route('search.topic', ['tag' => $tag->name]) }}">{{ $tag->name }}</a>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <aside action="{{route('search', $search)}}" class="col-md mb-4">

            <form method="get" id="filterform" onchange="this.submit()">
                <h5>Filtro</h5>
                <hr class="section-break mt-0" />

                <h6 class="mt-5">Pelo Tempo</h6>
                <hr class="section-break" />
                <label class="container-checkbox">Última Hora
                    <input type="radio" value="lastHour" name="time" <?php if($time == "lastHour") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Última Dia
                    <input type="radio" value="lastDay" name="time" <?php if($time == "lastDay") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Última Semana
                    <input type="radio" value="lastWeek" name="time" <?php if($time == "lastWeek") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Último Mês
                    <input type="radio" value="lastMounth" name="time" <?php if($time == "lastMouth") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Desde Sempre
                    <input type="radio" value="forever" name="time" <?php if($time == "forever") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>

                <h6 class="mt-5">Por Tópico</h6>
                <hr class="section-break" />
                <div class="content mb-4">
                    <select id="inputTag" class="js-example-basic-single" name="tag">
                        <script>
                            var myArray = <?php echo json_encode($tags_); ?>;
                            for (i = 0; i < myArray.length; i++) {
                                document.write('<option value="' + i + '">' + myArray[i] + '</option>');
                            }

                            document.getElementById("inputTag").selectedIndex = <?php echo json_encode($tag); ?>;

                        </script>
                    </select>

                </div>

            </form>

        </aside>
    </div>
</div>

<script>
    function filter(value) {
        window.location.href = value
    }
</script>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endsection