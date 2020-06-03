<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

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

<div class="nav-bar navbar-expand navbar-light bg-light pb-2">
    <nav class="navbar navbar-expand">

        <a class="navbar-brand mr-5" href="{{ url('home') }}">
            <img src="{{ asset('../images/logo.png') }}" width="35" height="42" class="d-inline-block align-center" alt="logo">
        </a>


        <div class="navbar-collapse navbar-nav form-inline justify-content-end">

            <button class="btn btn-secondary btn-sm mr-3" type="button" id="searchMobileButton" data-toggle="collapse" data-target="#searchBarInput" aria-expanded="false" aria-controls="searchBarInput">
                <i class="fa fa-search"></i>
            </button>

            @auth
            @isAdmin()
            @else
            <a class="btn btn-primary btn-sm mr-3" href="{{ route('add.questions') }}"><i class="fas fa-plus-circle" aria-label="Adicionar Pergunta"></i></a>
            @endisAdmin
            @endauth

            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </button>


                <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                    @auth

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
                    @endisAdmin

                    @endauth

                    @guest
                    <a class="dropdown-item" href="{{ route('login') }}">Iniciar Sessão</a>
                    <a class="dropdown-item" href="{{ route('login') }}">Registar</a>
                    @endguest
                </div>

            </div>

        </div>

    </nav>

    <div class="collapse mx-2 <?= (isset($search)) ? "show" : "" ?>" id="searchBarInput">
        <form class="input-group form-inline flex-fill mr-3" method="POST" action="{{ route('search.post') }}">
            @csrf
            <input name="search" type="text" class="form-control" placeholder="Pesquisa" required value="<?= (isset($search)) ? $search : "" ?>">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>