<?php
function drawHeaderMember()
{
?>

    <div class="sticky-top d-none d-xl-block">
        <?php drawHeaderMemberDesktop(); ?>
    </div>
    <div class="sticky-top d-xl-none">
        <?php drawHeaderMemberMobile(); ?>
    </div>



<?php
}

function drawHeaderMemberDesktop()
{
?>

    <nav class="navbar navbar-expand sticky-top navbar-light bg-light mb-4">

        <a class="navbar-brand mr-5" href="#">
            <img src="../logo.png" width="35" height="42" class="d-inline-block align-center" alt="">
            Papagaio
        </a>


        <form class="navbar-nav form-inline flex-fill ml-3">

            <div class="input-group flex-fill mr-3">
                <input type="text" class="form-control flex-fill" placeholder="Pesquisa">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <button type="button" class="btn btn-primary mr-4"><i class="fas fa-plus-circle mr-1"></i> Adicionar Questão</button>

            <div class="btn-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </button>

                <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="settings.php">Settings</a>
                </div>
            </div>

        </form>
    </nav>


<?php
}

function drawHeaderMemberMobile()
{
?>
    <div class="nav-bar navbar-expand navbar-light bg-light mb-4 pb-2">
        <nav class="navbar navbar-expand">

            <a class="navbar-brand mr-5" href="#">
                <img src="../logo.png" width="35" height="42" class="d-inline-block align-center" alt="">
            </a>


            <form class="navbar-collapse navbar-nav form-inline justify-content-end">

                <button class="btn btn-secondary btn-sm mr-3" type="button" data-toggle="collapse" data-target="#searchBarInput" aria-expanded="false" aria-controls="searchBarInput">
                    <i class="fa fa-search"></i></button>
                </button>

                <div class="btn-group">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </button>

                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="settings.php">Settings</a>
                    </div>
                </div>

            </form>

        </nav>

        <div class="collapse mx-2" id="searchBarInput">
            <?php popDownSearchBarMobile(); ?>
        </div>
    </div>

<?php
}

function popDownSearchBarMobile()
{
?>
    <div class="input-group flex-fill mr-3">
        <input type="text" class="form-control d-inline" placeholder="Pesquisa">
        <div class="input-group-append">
            <button class="btn btn-secondary" type="button">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>

<?php
}

function drawHeaderVisitor()
{
?>

    <div class="sticky-top d-none d-xl-block">
        <?php drawHeaderVisitorDesktop(); ?>
    </div>
    <div class="sticky-top d-xl-none">
        <?php drawHeaderMemberMobile(); ?>
    </div>

<?php }

function drawHeaderVisitorDesktop()
{
?>

    <nav class="navbar navbar-expand sticky-top navbar-light bg-light mb-4">

        <a class="navbar-brand mr-5" href="#">
            <img src="../logo.png" width="35" height="42" class="d-inline-block align-center" alt="">
            Papagaio
        </a>


        <form class="navbar-nav form-inline flex-fill ml-3">

            <div class="input-group flex-fill mr-3">
                <input type="text" class="form-control flex-fill" placeholder="Pesquisa">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <button type="button" class="btn btn-log-in mr-1">Iniciar sessão</button>
            <button type="button" class="btn btn-primary">Registar</button>

        </form>
    </nav>


<?php
}

function drawHeaderVisitorMobile()
{
?>
    <div class="nav-bar navbar-expand navbar-light bg-light mb-4 pb-2">
        <nav class="navbar navbar-expand">

            <a class="navbar-brand mr-5" href="#">
                <img src="../logo.png" width="35" height="42" class="d-inline-block align-center" alt="">
            </a>


            <form class="navbar-collapse navbar-nav form-inline justify-content-end">

                <button class="btn btn-secondary btn-sm mr-3" type="button" data-toggle="collapse" data-target="#searchBarInput" aria-expanded="false" aria-controls="searchBarInput">
                    <i class="fa fa-search"></i></button>
                </button>
                <button type="button" class="btn btn-primary btn-sm mr-3"><i class="fas fa-plus-circle"></i></button>

                <div class="btn-group">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </button>

                    <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="settings.php">Settings</a>
                    </div>
                </div>

            </form>

        </nav>

        <div class="collapse mx-2" id="searchBarInput">
            <?php popDownSearchBarMobile(); ?>
        </div>
    </div>

<?php
}
