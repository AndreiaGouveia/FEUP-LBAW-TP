@extends('layouts.app')


@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="form-center align-items-center pb-5">
    <h1 class="text-danger"><b>BANIDO!</b></h1>

    <h4 class="mt-5"><b>{{$member->name}}</b>, da última vez que nos visitou, violou as nossas regras de utilizador.</h4>
    <h4>Deste modo, foi banido da nossa pataforma!</h4>
    <br>
    <h5>Contacte o Admistrador</h5>

</div>

@endsection