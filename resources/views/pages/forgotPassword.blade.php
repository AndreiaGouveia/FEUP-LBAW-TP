@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="form-center align-items-center pb-5">
  <h2>Esqueceu-se da sua palavra-passe?!</h2>
  <h6><br></h6>

  <form class="login" method="POST" action="{{ url('/forgotPassword') }}">

    {{ csrf_field() }}

    @if(session('error'))
        <div> {{session('error')}} </div>
    @endif

    @if(session('sucess'))
        <div> {{session('sucess')}} </div>
    @endif
    
    <div class="content">
      <label for="inputEmail"><i class="fas fa-at"></i></label>
      <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email" value="{{ old('email') }}" required="" autofocus="" toggle="" data-placement="right" title="exemplo@email.com">
    </div>


    <button class="btn btn-lg btn-primary btn-block" type="submit">Submeter</button>

  </form>
</div>

@endsection