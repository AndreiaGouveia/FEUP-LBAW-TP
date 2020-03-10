<?php
include_once("../templates/popup.php");
include_once("../templates/question.php");

function drawProfileActivity()
{
?>
    <div>
        <h3 class="font-weight-normal mb-3">Atividade recente </h3>
        <?php
        drawAnswerActivity("04/03/2020", "O meu gato anda muito triste, o que se passa?", "Se o gato apenas parece triste, preste atenção se houve fatores recentes que possam ter desencadeado um quadro depressivo: você tem tido tempo para brincar com ele? A sua família tem dado atenção a ele? Há algum animal ou membro novo na família (ele pode estar com ciúmes)?");
        drawQuestionActivity("02/03/2020", "Qual o melhor sítio para passear o meu cão?", "Se o gato apenas parece triste, preste atenção se houve fatores recentes que possam ter desencadeado um quadro depressivo: você tem tido tempo para brincar com ele? A sua família tem dado atenção a ele? Há algum animal ou membro novo na família (ele pode estar com ciúmes)?");
        drawCommentToQuestionActivity("01/03/2020", "Porque é que o meu gato não anda a comer?", "O seu gato tem andando triste? Poderá ser um motivo...");
        drawCommentToAnswerActivity("01/03/2020", "Porque é que o meu gato não anda a comer?", "Não concordo com esta resposta! Cuidado!");

        ?>
    </div>
<?php

}

function drawHeaderActivity($name, $action, $actionInBold, $date)
{
?>

    <div id="header-card d-inline">
        <img src="..\\images\profile_picture1.png" class="img_inside mr-2" alt="">
        <div class="header-text">
            <p class="mb-0 font-weight-bold d-inline"><?= $name ?></p>
            <p class="mb-0 d-inline"><?= $action ?></p>
            <p class="mb-0 font-weight-bold d-inline"><?= $actionInBold ?>
                <p class="mb-3"><?= $date ?></p>
        </div>
    </div>

<?php
}


function drawBasicActivity($date, $title, $description)
{
?>
    <div class="activity py-4 px-4 border-top">
        <a href="../pages/question.php" class="hiperlink-in-activity">
            <?php drawHeaderActivity("João Pinheiro", "", "", $date); ?>
            <h5 class="title"><?= $title ?></h5>
            <p class="text"><?= $description ?></p>
            <?php drawInfoBasicActivity(); ?>
        </a>
    </div>

<?php

}

function drawInfoBasicActivity()
{
?>
    <div class="row justify-content-between mt-3 px-0 mx-0">
        <?php drawTopicsInCard(); ?>
        <div class="info row justify-content-end mx-0">
            <?php drawLikeButtons(); ?>
        </div>

    </div>
<?php
}

function drawLikeButtons()
{

?>

    <button type="radio" class="btn px-1 py-0 ml-4" toggle="" data-placement="bottom" title="Eu gosto disto">
        <i class="far fa-thumbs-up"></i>
        <label style="margin-bottom: 0px">17</label>
    </button>

    <button type="radio" class="btn px-1 py-0 ml-2" toggle="" data-placement="bottom" title="Eu não gosto disto">
        <i class="far fa-thumbs-down d-inline"></i>
        <label style="margin-bottom: 0px" class="d-inline">7</label>
    </button>

<?php
}

function drawAnswerActivity($date, $title, $response)
{
?>

    <div class="activity py-4 px-4 border-top ">
        <a href="../pages/question.php" class="hiperlink-in-activity">
            <?php drawHeaderActivity("João Pinheiro", "respondeu a", $title, $date); ?>
            <p class="card-text"><?= $response ?></p>
            <div class="info row justify-content-end align-items-center mx-0">
                <?php drawLikeButtons(); ?>
            </div>
        </a>
    </div>

<?php
}

function drawQuestionActivity($date, $title, $description)
{
?>


    <div class="activity py-4 px-4 border-top">
        <a href="../pages/question.php" class="hiperlink-in-activity">
            <?php drawHeaderActivity("João Pinheiro", "perguntou:", "", $date); ?>
            <h5 class="title"><?= $title ?></h5>
            <p class="text"><?= $description ?></p>
            <?php drawInfoBasicActivity(); ?>
        </a>
    </div>

<?php
}

function drawCommentToAnswerActivity($date, $title, $response)
{
?>


    <div class="activity py-4 px-4 border-top">
        <a href="../pages/question.php" class="hiperlink-in-activity">
            <?php drawHeaderActivity("João Pinheiro", "comentou uma resposta a", $title, $date); ?>
            <p class="card-text"><?= $response ?></p>
        </a>
    </div>

<?php
}

function drawCommentToQuestionActivity($date, $title, $response)
{
?>


    <div href="../pages/question.php" class="activity py-4 px-4 border-top">
        <a href="../pages/question.php" class="hiperlink-in-activity">
            <?php drawHeaderActivity("João Pinheiro", "comentou", $title, $date); ?>
            <p class="card-text"><?= $response ?></p>
        </a>
    </div>

<?php
}

?>