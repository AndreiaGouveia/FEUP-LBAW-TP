<nav class="navbar navbar-expand sticky-top navbar-light bg-light">

<a class="navbar-brand px-2 mr-5" href="{{ url('home') }}">
    <img src="{{ asset('../images/logo.png') }}" width="35" height="42" class="d-inline-block align-center" alt="">
    Papagaio
</a>


<div class="navbar-nav form-inline flex-fill ml-3">

    <form class="input-group flex-fill mr-3" action="../pages/search.php">
        <input name="search" type="text" class="form-control flex-fill" placeholder="Pesquisa">
        <div class="input-group-append">
            <button class="btn btn-secondary" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>

    @auth
    <a type="button" class="btn btn-primary mr-4" href="add_question.php"><i class="fas fa-plus-circle mr-1"></i> Adicionar Pergunta</a>
    

    <div class="btn-group">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i>
        </button>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <div class="dropdown-item">
                <img src="{{ asset('../images/profile_picture1.png') }}" class="img-header float-left" alt="">
                <p style="margin-left: 1.7rem">João Pinheiro<span class="badge badge-light"><i class="fas fa-shield-alt"></i></span></p>
            </div>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="profile.php">O meu Perfil</a>
            <a class="dropdown-item" href="my_content.php">O meu Conteúdo</a>
            <a class="dropdown-item" href="my_favorites.php">Favoritos</a>
            <a class="dropdown-item" href="settings.php">Definições</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../pages/main_page.php">Terminar Sessão</a>
    
        </div>
    </div>
    @endauth

    @guest
        <a type="button" class="btn btn-log-in mr-1" href="{{ url('login') }}">Iniciar sessão</a>
        <a type="button" class="btn btn-primary" href="{{ url('register') }}">Registar</a>
    @endguest

</div>
</nav>