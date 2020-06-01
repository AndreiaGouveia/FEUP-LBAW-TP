@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/graph.css') }}">

@endsection

@section('content')

@foreach($monthly_activity_info as $tets)
{{$tets}}
@endforeach

<div class="col-md-7 mx-auto">
    <div class=" mt-5">
        <h1 class="font-weight-normal mb-3">Painel do Admistrador</h1>
        <hr class="section-break" />

    </div>

    <div class="row d-flex justify-content-between mx-2 mb-5">
        <div class="graph">
            <h3 class="ml-2 mb-2">Tags mais populares</h3>
            <canvas id="myChart" width="5" height="3"></canvas>
        </div>
        <div class="graph">
            <h3 class="ml-2 mb-2">Número de Posts nos últimos 12 meses</h3>
            <canvas id="myChart2" width="5" height="3"></canvas>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($popular_tags_legend); ?>,
                datasets: [{
                    label: '# of Posts',
                    data: <?php echo json_encode($popular_tags_info); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

<script>
        var ctx = document.getElementById('myChart2');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($monthly_activity_legend); ?>,
                datasets: [{
                    label: '# of Posts',
                    data: <?php echo json_encode($monthly_activity_info); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <h3 class="ml-2 mb-2">Ações</h3>
    <div class="row d-flex justify-content-around">
        <a class="btn btn-secondary btn-sm m-2" href="{{ route('reports')}}">
            <h3 class="m-2">Conteúdo Reportado</h3>
        </a>
        <a class="btn btn-secondary btn-sm m-2" href="{{ route('reports')}}">
            <h3 class="m-2">Editar Página Sobre Nós</h3>
        </a>
    </div>


</div>


@endsection