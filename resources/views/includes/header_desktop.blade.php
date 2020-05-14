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
        $link = ($member->photo != null) ? $member->photo->url : "https://i.stack.imgur.com/l60Hf.png";
        $name = $member->name;
    }
}
?>

<nav class="navbar navbar-expand sticky-top navbar-light bg-light">

    <a class="navbar-brand px-2 mr-5" href="{{ url('home') }}">
        <img src="{{ asset('../images/logo.png') }}" width="35" height="42" class="d-inline-block align-center" alt="">
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
        <a type="button" class="btn btn-primary mr-4" href="{{ route('add.questions') }}"><i class="fas fa-plus-circle mr-1"></i> Adicionar Pergunta</a>

        <div class="btn-group">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
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
            </div>
        </div>
        @endauth

        @guest
        <a type="button" class="btn btn-log-in mr-1" href="{{ route('login') }}">Iniciar sessão</a>
        <a type="button" class="btn btn-primary" href="{{ route('register') }}">Registar</a>
        @endguest

    </div>
</nav>