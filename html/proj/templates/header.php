<?php
function drawHeaderMember()
{
?>
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light mb-4">
        <a class="navbar-brand" href="#">
            <img src="../logo.png" width="35" height="42" class="d-inline-block align-center" alt="">
            Papagaio
        </a>

        <div class="navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">

            <form class="navbar-nav form-inline">
                <input class="form-control" type="search" placeholder="Pesquisar" aria-label="Search">
                <button type="button" class="btn mr-3"><i class="fas fa-search"></i></button>

                <button type="button" class="btn btn-primary mr-3"><i class="fas fa-plus-circle mr-1"></i> Adicionar Questão</button>
                <div class="btn-group">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </button>
                </div>
            </form>
        </div>
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

        <div class="navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">

            <form class="navbar-nav form-inline">
                <input class="form-control" type="search" placeholder="Pesquisar" aria-label="Search">
                <button type="button" class="btn mr-3"><i class="fas fa-search"></i></button>

                <button type="button" class="btn btn-primary mr-3"><i class="fas fa-plus-circle mr-1"></i> Adicionar Questão</button>
                <button type="button" class="btn btn-log-in mr-1">Iniciar sessão</button>
                <button type="button" class="btn btn-primary">Registar</button>
            </form>
        </div>
    </nav>

<?php } ?>