<?php
function drawHeaderMember()
{
?>
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light mb-4">
        <a class="navbar-brand mr-5" href="#">
            <img src="../logo.png" width="35" height="42" class="d-inline-block align-center" alt="">
            Papagaio
        </a>

        <div class="navbar-collapse d-flex ml-5" id="navbarSupportedContent">

            <form class="navbar-nav form-inline flex-fill">

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
        <a class="navbar-brand mr-5" href="#">
            <img src="../logo.png" width="35" height="42" class="d-inline-block align-center" alt="">
            Papagaio
        </a>

        <div class="navbar-collapse d-flex ml-5" id="navbarSupportedContent">

            <form class="navbar-nav form-inline flex-fill">
                <div class="input-group flex-fill mr-3">
                    <input type="text" class="form-control flex-fill" placeholder="Pesquisa">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <button type="button" class="btn btn-primary mr-3"><i class="fas fa-plus-circle mr-1"></i> Adicionar Questão</button>
                <button type="button" class="btn btn-log-in mr-1">Iniciar sessão</button>
                <button type="button" class="btn btn-primary">Registar</button>
            </form>
        </div>
    </nav>

<?php } ?>