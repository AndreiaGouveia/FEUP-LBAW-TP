<?php

use Illuminate\Support\Facades\Auth;

if (Auth::check()) {

    if (Auth::user()->isAdmin()) {
        $link = "images/admin.png";
        $name = "Administrator";
    } else {
        $member = Auth::user()->member;
        $link = ($member->photo != null) ? $member->photo->url : "images/default.png";
        $name = $member->name;
    }
}
?>

<nav class="navbar navbar-expand navbar-light bg-light">

    <a class="navbar-brand px-2 mr-5" href="{{ url('home') }}">
        <img src="{{ asset('../images/logo.png') }}" width="35" height="42" class="d-inline-block align-center" alt="logo">
        Papagaio
    </a>


    <div class="navbar-nav form-inline flex-fill ml-3">

        <form class="input-group flex-fill mr-3" method="POST" action="{{ route('search.post') }}">
            @csrf
            <input name="search" type="text" class="form-control flex-fill" placeholder="Pesquisa" required value="<?= (isset($search)) ? $search : "" ?>">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>

        @auth
        @isAdmin()
        @else
        <a class="btn btn-primary mr-4" href="{{ route('add.questions') }}"><i class="fas fa-plus-circle mr-1"></i> Adicionar Pergunta</a>
        @endisAdmin

        <div class="btn-group">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <div class="dropdown-item">
                    <img src='{{asset("storage/$link")}}' class="img-header float-left" alt="userPic">
                    @isModerator()
                    <p style="margin-left: 1.7rem">{{$name}}<span class="badge badge-light"><i class="fas fa-shield-alt" aria-label="Moderador"></i></span></p>
                    @else
                    <p>loool</p>
                    <p style="margin-left: 1.7rem">{{$name}}</p>
                    @endisModerator()
                    </div>

                @isAdmin()
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.panel') }}">Painel do Admistrador</a>
                <a class="dropdown-item" href="{{ route('about.edit') }}">Editar página 'Sobre Nós'</a>
                <a class="dropdown-item" href="{{ route('reports') }}">Conteúdo Reportado</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Terminar Sessão</a>
                @else
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('members', Auth::user()->id) }}">O meu Perfil</a>
                <a class="dropdown-item" href="{{ route('member.content', Auth::user()->id) }}">O meu Conteúdo</a>
                <a class="dropdown-item" href="{{ route('member.favorites', Auth::user()->id) }}">Favoritos</a>
                <a class="dropdown-item" href="{{ route('settings', Auth::user()->id) }}">Definições</a>
                @isModerator()
                <a class="dropdown-item" href="{{ route('reports') }}">Conteúdo Reportado</a>
                @endisModerator()
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">Terminar Sessão</a>
                @endisAdmin()
            </div>
        </div>
        @endauth

        @guest
        <a class="btn btn-log-in mr-1" href="{{ route('login') }}">Iniciar sessão</a>
        <a class="btn btn-primary" href="{{ route('register') }}">Registar</a>
        @endguest

    </div>
</nav>