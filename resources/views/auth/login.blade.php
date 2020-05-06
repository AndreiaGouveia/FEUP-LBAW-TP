@extends('layouts.app')


@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="form-center align-items-center pb-5">
    <h2>Bem Vindo!</h2>
    <h6><br></h6>

    <form class="login mt-5" method="POST" action="{{ route('login') }}">

        {{ csrf_field() }}

        <div class="content">
            <label for="inputEmail"><i class="fas fa-at"></i></label>
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" value="{{ old('email') }}" required="" autofocus="" toggle="" data-placement="bottom" title="exemplo@email.com">
        </div>
        @if ($errors->has('email'))
        <span class="error">
            {{ $errors->first('email') }}
        </span>
        @endif

        <div class="content">
            <label for="inputPassword"><i class="fas fa-key"></i></label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Palavra-passe" required="" toggle="" data-placement="bottom" title="Introduza a sua password">
        </div>
        @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
        @endif

        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sessão</button>

        <div class="m-3"><a class="card-text" href="#">Esqueceu-se da sua palavra-passe?</a></div>

        <hr class="section-break" />

        <a class="btn btn-outline-dark" href="#" role="button" style="text-transform:none">
            <img width="20px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
            Iniciar sessão com o Google
        </a>

    </form>
</div>

@endsection