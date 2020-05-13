<?php


use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    if (Auth::user()->id == 1) {
        $admin = 1;
        $link = "https://pngimage.net/wp-content/uploads/2018/06/logo-admin-png-4.png";
        $name = "Administrator";
    } else {
        $admin = 0;
        $member = App\Member::find(Auth::user()->id);
        $link = ($member->photo()->first() != null) ? $member->photo()->first()->url : "https://i.stack.imgur.com/l60Hf.png";
        $name = $member->name;
    }
}
?>

<div class="nav-bar navbar-expand navbar-light bg-light pb-2">
    <nav class="navbar navbar-expand">

        <a class="navbar-brand mr-5" href="home">
            <img src="{{ asset('../images/logo.png') }}" width="35" height="42" class="d-inline-block align-center" alt="">
        </a>


        <div class="navbar-collapse navbar-nav form-inline justify-content-end">

            <button class="btn btn-secondary btn-sm mr-3" type="button" id="searchMobileButton" data-toggle="collapse" data-target="#searchBarInput" aria-expanded="false" aria-controls="searchBarInput">
                <i class="fa fa-search"></i></button>
            </button>

            @auth
            <a type="button" class="btn btn-primary btn-sm mr-3" href="{{ route('add.questions') }}"><i class="fas fa-plus-circle"></i></a>
            @endauth

            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </button>


                <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    @auth

                    <div class="dropdown-item">
                        <img src=<?= $link ?> class="img-header float-left" alt="">
                        <p style="margin-left: 1.7rem"><?= $name ?><span class="badge badge-light"><i class="fas fa-shield-alt"></i></span></p>
                    </div>

                    @if($admin)
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item">Editar página 'Sobre Nós'</a>
                    <a class="dropdown-item">Conteúdo sinalizado</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Terminar Sessão</a>
                    @else
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('members', Auth::user()->id) }}">O meu Perfil</a>
                    <a class="dropdown-item" href="{{ route('member.content', Auth::user()->id) }}">O meu Conteúdo</a>
                    <a class="dropdown-item" href="{{ route('member.favorites', Auth::user()->id) }}">Favoritos</a>
                    <a class="dropdown-item" href="{{ route('settings', Auth::user()->id) }}">Definições</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Terminar Sessão</a>
                    @endif
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