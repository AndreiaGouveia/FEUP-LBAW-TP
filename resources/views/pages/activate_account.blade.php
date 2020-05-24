@extends('layouts.app')


@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="form-center align-items-center pb-5">
    <h1>Bem Vindo Novamente!</h1>

    <h4 class="mt-5">Da última vez que nos visitou, desativou a sua conta!</h4>
    <h4>Deseja participar novamente na maior comunidade do Reino Animal?</h4>

    <form class="login mt-5" method="POST" action="{{ route('members.show.activate', $id) }}">

        {{ csrf_field() }}

        <button class="btn btn-lg btn-primary btn-block" type="submit">Ativar Conta</button>

    </form>
</div>

@endsection