@extends('layouts.app')

@section('title')
{{ $search . " - Pesquisa Tópico" }}
@endsection

@section('stylesheets')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/settings.css') }}">
@endsection


@section('content')

<div class="container mt-5">
    <div class="row flex-column-reverse flex-lg-row">

        <div class="main-content col-md-8">
            <div class="mb-3">
                <h2 class="font-weight-normal text-secondary d-inline">Perguntas com o tópico </h2>
                <h2 class="d-inline">{{$search}}</h2>
            </div>

            <div class="row container justify-content-between mb-4">
                <div class="list-group list-group-horizontal mb-2" id="list-tab" role="tablist"></div>

                <select name="filter" class="custom-select" form="filterform" onchange="this.form.submit();">
                    <option value="relevant" <?php if ($filter == "relevant") echo "selected" ?>>Relevante</option>
                    <option value="recent" <?php if ($filter == "recent") echo "selected" ?>>Recente</option>
                    <option value="mostLiked" <?php if ($filter == "mostLiked") echo "selected" ?>>Mais Gostados</option>
                    <option value="leastLiked" <?php if ($filter == "leastLiked") echo "selected" ?>>Menos Gostados</option>
                </select>

            </div>
            @each('activities.basic_activity', $questions, 'question')
            {{ $questions->links() }}
        </div>

        <aside action="{{route('search', $search)}}" class="col-md mb-4">

            <form method="get" id="filterform" onchange="this.submit()">
                <h5>Filtro</h5>
                <hr class="section-break mt-0" />

                <h6 class="mt-5">Pelo Tempo</h6>
                <hr class="section-break" />
                <label class="container-checkbox">Última Hora
                    <input type="radio" value="lastHour" name="time" <?php if ($time == "lastHour") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Última Dia
                    <input type="radio" value="lastDay" name="time" <?php if ($time == "lastDay") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Última Semana
                    <input type="radio" value="lastWeek" name="time" <?php if ($time == "lastWeek") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Último Mês
                    <input type="radio" value="lastMonth" name="time" <?php if ($time == "lastMonth") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>
                <label class="container-checkbox">Desde Sempre
                    <input type="radio" value="forever" name="time" <?php if ($time == "forever") echo "checked" ?>>
                    <span class="checkmark"></span>
                </label>

            </form>

        </aside>
    </div>
</div>

<script>
    function filter(value) {
        window.location.href = value;
    }
</script>

@endsection