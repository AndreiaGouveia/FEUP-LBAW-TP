<div class="nav-bar navbar-expand navbar-light bg-light pb-2">
    <nav class="navbar navbar-expand">

        <a class="navbar-brand mr-5" href="../pages/main_page.php">
            <img src="{{ asset('../images/logo.png') }}" width="35" height="42" class="d-inline-block align-center" alt="">
        </a>


        <div class="navbar-collapse navbar-nav form-inline justify-content-end">

            <button class="btn btn-secondary btn-sm mr-3" type="button" id="searchMobileButton" data-toggle="collapse" data-target="#searchBarInput" aria-expanded="false" aria-controls="searchBarInput">
                <i class="fa fa-search"></i></button>
            </button>

            <?php /*@auth('guest')*/ ?>
            <a type="button" class="btn btn-primary btn-sm mr-3" href="add_question.php"><i class="fas fa-plus-circle"></i></a>

            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </button>


                <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <?php /*@auth('guest')*/ ?>


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

                    <?php /* @else */ ?>

                    <!--    
                        <a class="dropdown-item" href="login.php">Iniciar Sessão</a>
                        <a class="dropdown-item" href="sign_up.php">Registar</a>-->
                    <?php /*@endauth*/ ?>
                </div>

            </div>

        </div>

    </nav>

    <div class="collapse mx-2" id="searchBarInput">
        <form class="input-group form-inline flex-fill mr-3" action="../pages/search.php">
            <input name="search" type="text" class="form-control" placeholder="Pesquisa">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>