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
                <h2 class="font-weight-normal text-secondary d-inline">Perguntas com o tópico </h2>
                <h2 class="d-inline"><?= $search ?></h2>
            </div>

            <div class="row container justify-content-between mb-4">
                <div class="list-group list-group-horizontal mb-2" id="list-tab" role="tablist"></div>
                <select id="filter" class="custom-select" onchange="filter(this.value)">
                    <option value="{{ route('filtered.search.topic', ['tag' => $search, 'filter' => 'relevant']) }}">Relevante</option>
                    <option value="{{ route('filtered.search.topic', ['tag' => $search, 'filter' => 'recent']) }}">Recente</option>
                    <option value="{{ route('filtered.search.topic', ['tag' => $search, 'filter' => 'mostLiked']) }}">Mais Gostados</option>
                    <option value="{{ route('filtered.search.topic', ['tag' => $search, 'filter' => 'leastLiked']) }}">Menos Gostados</option>
                    
                    <script>
                        document.getElementById("filter").selectedIndex = <?php echo json_encode($filter); ?>;
                    </script>
                </select>
            </div>

            @each('partials.basic_activity', $questions, 'question')
        </div>
        <div class="col-md mb-4">
            <h6>Tópicos Populares</h6>
            <hr class="section-break" />
            @foreach ($popular_tags as $tag)
            @include('partials.tag', ["tag" => $tag->name])
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