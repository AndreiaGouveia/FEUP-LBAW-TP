<?php
function drawHeaderMember()
{
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="../logo.png" width="40" height="50" class="d-inline-block align-center" alt="">
            Papagaio
        </a>

        <form class="form-inline">

            <button class="btn search"><i class="fas fa-search"></i></button>
            <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">
            <button type="button" class="btn btn-primary mr-3"><i class="fas fa-plus-circle mr-1"></i> Adicionar Questão</button>
            <button class="btn search"><i class="fas fa-search"></i></button>

            <div class="btn-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </button>
            </div>
        </form>

    </nav>

<?php } ?>

<?php
function drawHeaderVisitor()
{
?>
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light mb-4">
        <a class="navbar-brand" href="#">
            <img src="../logo.png" width="40" height="50" class="d-inline-block align-center" alt="">
            Papagaio
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
            <form class="navbar-nav form-inline">
                <input class="form-control mr-auto" type="search" placeholder="Pesquisar" aria-label="Search">

                <button type="button" class="btn mr-3"><i class="fas fa-search"></i></button>
                <button type="button" class="btn btn-log-in mr-1">Iniciar sessão</button>
                <button type="button" class="btn btn-primary">Registar</button>
            </form>
        </div>
    </nav>

<?php } ?>