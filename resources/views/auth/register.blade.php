@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="form-center align-items-center pb-5">
  <h2>Junte-se à nossa comunidade!</h2>
  <h6><br></h6>

  <form class="login" method="POST" action="{{ route('register') }}">

    {{ csrf_field() }}

    <div class="content mt-3 flex-fill">
      <label for="inputName"><i class="fas fa-user"></i></label>
      <input name="name" type="text" id="inputName" class="form-control" placeholder="Nome" value="{{ old('name') }}" required="" autofocus="" toggle="" data-placement="right" title="Introduza o seu nome">
    </div>
    @if ($errors->has('name'))
    <span class="error">
      {{ $errors->first('name') }}
    </span>
    @endif

    <div class="content">
      <label for="inputEmail"><i class="fas fa-at"></i></label>
      <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" value="{{ old('email') }}" required="" autofocus="" toggle="" data-placement="right" title="exemplo@email.com">
    </div>
    @if ($errors->has('email'))
    <span class="error">
      {{ $errors->first('email') }}
    </span>
    @endif

    <div class="content">
      <label for="inputPassword"><i class="fas fa-key"></i></label>
      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Palavra-passe" required="" toggle="" data-placement="right" title="A password tem de possuir um caracterer maiúsculo, minúsculo, especial, um número e ter pelo menos 8 caracteres.">
    </div>
    @if ($errors->has('password'))
    <span class="error">
      {{ $errors->first('password') }}
    </span>
    @endif

    <div class="content">
      <label for="inputPassword my-auto"><i class="fas fa-check"></i></label>
      <input name="password_confirmation" type="password" id="inputPassword" class="form-control" placeholder="Confirmar Palavra-passe" required="" toggle="" data-placement="right" title="A password tem de possuir um caracterer maiúsculo, minúsculo, especial, um número e ter pelo menos 8 caracteres.">
    </div>

    <div class="checkbox m-3">
      <label>
        <input type="checkbox" required> Eu aceito os termos e condições.
      </label>
      <br>
      <label>
        <a href="{{ url('/forgotPassword') }}"> Esqueceu-se da sua palavra-passe? </a>
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Registar</button>


    <hr class="section-break" />


    <a class="btn btn-outline-dark" href="{{ route('registerGoogle') }}" role="button" style="text-transform:none">
      <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
      Registar com o Google
    </a>

  </form>
</div>

@endsection