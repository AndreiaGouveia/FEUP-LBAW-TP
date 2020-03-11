<?php

include_once("../templates/profile_activity.php");
include_once("../templates/topic.php");
include_once("../templates/popup.php");

function drawQuestion()
{
    drawHeaderActivity("João Pinheiro", "perguntou:", "", "22/02/2020");
?>
    <h2>É verdade que ração seca faz mal para gatos?</h2>

    <div class="description mt-3">
        <p>Chegou até a mim um guia de receita para comida de gatos (comida caseira balanceada) - até aí tudo bem, seria uma opção.

        Mas acontece que eles contam uma porção de coisas que eu não sabia sobre a ração seca (industrializada) e fiquei horrorizada!!

        Alguém tem experiência com nutrição animal (especialmente gatos) e saberia me dizer se a ração seca realmente não é boa para os bichanos??!!</p>
    </div>

    <div class="row justify-content-between align-items-center mt-4 mb-3 px-0 mx-0">
        <div class="topics align-items-center">
            <?php
            drawTopicsInCard();
            ?>
        </div>

        <div class="info row justify-content-end align-items-center mx-0">
            <?php drawInfoContent("commentSectionQuestion"); ?>
        </div>

    </div>


    <div class="commentSection collapse" id="commentSectionQuestion">
        <?php drawCommentSection(); ?>
    </div>

<?php
}

function drawInfoContent($idOfCommentSection)
{
?>

    <button class="btn px-2 py-0" data-toggle="collapse" toggle="" data-placement="bottom" title="Deixe o seu comentário" data-target="#<?= $idOfCommentSection ?>" aria-expanded="false" aria-controls=<?= $idOfCommentSection ?>>
        <i class="far fa-comment"></i>
        <label style="margin-bottom: 0px" class="pl-1">Comentar</label>
    </button>

    <?php drawLikeButtons(); ?>

    <button class="btn px-1 py-0 ml-4" toggle="" data-placement="bottom" title="Guardar">
        <i class="far fa-star"></i>
    </button>


    <div class="dropdown">
        <button class="btn px-1 py-0 ml-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Editar</a>
            <a class="dropdown-item" href="#">Eliminar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-toggle="modal" data-target="#<?= $idOfCommentSection ?>">Reportar</a>
        </div>
    </div>

    <?php reportPopUp($idOfCommentSection); ?>


<?php
}

function drawRecomendations()
{

?>

    <h6>Recomendações</h6>
    <hr class="section-break" />
    <div class="recommendations-tab">
        <a href="../pages/question.php">
            <p class="card-text" id="ISTO">Será que o meu cão está demasiado gordo?</p>
        </a>
        <a href="../pages/question.php">
            <p class="card-text">Como domisticar um crocodilo?</p>
        </a>
    </div>

<?php
}

function drawAddQuestion($titlePage, $titleQuestion = "", $description = "", $topics = "")
{
?>
    <h3 class="font-weight-normal mb-3"><?= $titlePage ?></h3>
    <hr class="section-break" />

    <form>
        <div class="form-group">

            <div class="content mb-4">
                <label for="inputTitle">Titulo</label>
                <input id="inputTitle" class="form-control" placeholder="Titulo" required="" autofocus="" value="<?= $titleQuestion ?>">
            </div>

            <div class="content mb-4">
                <label for="textAreaDescription">Descrição</label>
                <textarea id="textAreaDescription" class="form-control" placeholder="Descrição" required="" autofocus="" rows="6"><?= $description ?></textarea>
            </div>

            <div class="content mb-4">
                <label for="inputTopics">Tópicos</label>
                <input id="inputTopics" class="form-control" placeholder="Tópicos" required="" autofocus="" value="<?= $topics ?>">
            </div>

            <div class="d-flex justify-content-end d-inline">
                <button class="btn btn-secondary mr-2">Cancelar</button>
                <button type="submit" class="btn btn-primary"><?= $titlePage ?>
            </div>

        </div>
    </form>

<?php
}
?>