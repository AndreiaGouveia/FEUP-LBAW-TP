@extends('layouts.app')

@section('title')
About Us
@endsection

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">

@endsection

@section('content')

<div class="col-md-7 mx-auto">
    <div class=" mt-5">
        <h1 class="font-weight-normal mb-3">Sobre Nós</h1>
        <hr class="section-break" />

    </div>

    @markdown($description)

</div>


@endsection