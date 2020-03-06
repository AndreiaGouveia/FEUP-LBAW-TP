<?php
function drawHeaderMember()
{
?>

    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light mb-4">
        <a class="navbar-brand" href="#">
            <img src="../logo.png" width="35" height="42" class="d-inline-block align-center" alt="">
            Papagaio
        </a>

        <form class="form-inline">

            <input class="form-control mr-auto" type="search" placeholder="Pesquisar" aria-label="Search">

            <button type="button" class="btn mr-3"><i class="fas fa-search"></i></button>
            <button type="button" class="btn btn-log-in mr-1">Iniciar sessão</button>
            <button type="button" class="btn btn-primary">Registar</button>
        </form>

    </nav>

<?php } ?>

<?php
function drawHeaderVisitor()
{
?>
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light mb-4">
        <a class="navbar-brand" href="#">
            <img src="../logo.png" width="35" height="42" class="d-inline-block align-center" alt="">
            Papagaio
        </a>

        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
            
            <form class="navbar-nav form-inline">
                <input class="form-control" type="search" placeholder="Pesquisar" aria-label="Search">

                <button type="button" class="btn mr-3"><i class="fas fa-search"></i></button>
                <button type="button" class="btn btn-log-in mr-1">Iniciar sessão</button>
                <button type="button" class="btn btn-primary">Registar</button>
            </form>
        </div>
    </nav>

<?php } ?>