<?php
function drawHeaderMember()
{
?>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="../logo.png" width="40" height="50" class="d-inline-block align-center" alt="">
            Papagaio
        </a>

        <button type="button" class="btn button"><span><i class="fas fa-plus-circle"></i></span></button>

        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">
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
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="../logo.png" width="40" height="50" class="d-inline-block align-center" alt="">
            Papagaio
        </a>

        <button type="button" class="btn button"><span><i class="fas fa-plus-circle"></i></span></button>

        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">
            <button class="btn"><i class="fas fa-search"></i></button>

            <button type="button" class="btn btn-link">Iniciar sessão</button>
            <button type="button" class="btn btn-primary">Registar</button>
        </form>

    </nav>
<?php } ?>