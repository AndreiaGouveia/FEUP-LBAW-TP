@extends('layouts.app')

@section('title')
Definições
@endsection

@section('stylesheets')

<link rel="stylesheet" type="text/css" href="{{ asset('css/settings.css') }}">

@parent
@endsection

@section('content')


<div class="container mt-5">
<h3 class="font-weight-normal mb-3">Alterar Palavra-Passe</h3>
<hr class="section-break" />

<form role="form" method="POST" action="{{ route('reset.password', ['id' => $user->id] )}}">
    <div class="form-group">

        @csrf

        <div class="content mb-4">
            <label for="inputNewPassword">Nova Palavra-Passe</label>
            <input type="password" name="password" id="inputNewPassword" class="form-control" placeholder="Nova Palavra-Passe" required="" autofocus="">
        </div>

        <div class="content mb-4">
            <label for="inputConfirmationOfNewPassword">Confirmação de Nova Palavra-Passe</label>
            <input type="password" name="password_confirmation" id="inputConfirmationOfNewPassword" class="form-control" placeholder="Confirmação de Nova Palavra-Passe" required="" autofocus="">
        </div>
        @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
        @endif

        <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Atualizar Palavra-Passe</button></div>

    </div>
</form>
        
</div>

@endsection