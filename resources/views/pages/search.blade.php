@extends('layouts.app')

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
        <div class="col-md-8">

            <div class="mb-3">
                <h2 class="font-weight-normal text-secondary d-inline">Resultados de Pesquisa para </h2>
                <h2 class="d-inline"><?= $search ?></h2>
            </div>

            <div class="row container justify-content-between mb-4">
                <div class="list-group list-group-horizontal mb-2" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active py-2" id="list-questions-list" data-toggle="list" href="#list-questions" role="tab" aria-controls="questions">Perguntas</a>
                    <a class="list-group-item list-group-item-action py-2" id="list-topics-list" data-toggle="list" href="#list-topics" role="tab" aria-controls="topics">Tópicos</a>
                </div>
                <select id="filter" class="custom-select" onchange="filter(this.value)">
                    <option value="{{ route('filtered.search', ['search' => $search, 'filter' => 'relevant']) }}">Relevante</option>
                    <option value="{{ route('filtered.search', ['search' => $search, 'filter' => 'recent']) }}">Recente</option>
                    <option value="{{ route('filtered.search', ['search' => $search, 'filter' => 'mostLiked']) }}">Mais Gostados</option>
                    <option value="{{ route('filtered.search', ['search' => $search, 'filter' => 'leastLiked']) }}">Menos Gostados</option>
                    
                    <script>
                        document.getElementById("filter").selectedIndex = <?php echo json_encode($filter); ?>;
                    </script>
                </select>
            </div>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-questions" role="tabpanel" aria-labelledby="list-questions-list">
                    @each('activities.basic_activity', $questions, 'question')
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
        <div class="col-md mb-4">
            <h6>Tópicos Populares</h6>
            <hr class="section-break" />
            @foreach ($popular_tags as $tag)
            @include('interation.tag', ["tag" => $tag->name])
            @endforeach
        </div>
    </div>
</div>

<script>
    function filter(value) {
        window.location.href = value;
    }
</script>

@endsection