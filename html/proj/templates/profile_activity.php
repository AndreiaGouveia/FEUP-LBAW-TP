<?php
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
        <img src="..\profile_picture.png" class="img_inside mr-2" alt="">
        <div class="header-text">
            <p class="mb-0 font-weight-bold d-inline"><?= $name ?></p>
            <p class="mb-0 d-inline"><?= $action ?></p>
            <p class="mb-0 font-weight-bold d-inline"><?= $actionInBold ?>
                <p class="mb-3"><?= $date ?></p>
        </div>
    </div>

<?php
}

function drawAnswerActivity($date, $title, $response)
{
?>

    <div href="#" class="activity py-4 px-4 border-top ">
        <?php drawHeaderActivity("João Pinheiro", "respondeu a", $title, $date); ?>
        <p class="card-text"><?= $response ?></p>
    </div>

<?php
}

function drawQuestionActivity($date, $title, $description)
{
?>


    <div href="#" class="activity py-4 px-4 border-top">
        <?php drawHeaderActivity("João Pinheiro", "perguntou:", "", $date); ?>
        <h5 class="title"><?= $title ?></h5>
        <p class="text"><?= $description ?></p>
    </div>

<?php
}

function drawCommentToAnswerActivity($date, $title, $response)
{
?>


    <div href="#" class="activity py-4 px-4 border-top">
        <?php drawHeaderActivity("João Pinheiro", "comentou uma resposta a", $title, $date); ?>
        <p class="card-text"><?= $response ?></p>
    </div>

<?php
}

function drawCommentToQuestionActivity($date, $title, $response)
{
?>


    <div href="#" class="activity py-4 px-4 border-top">
        <?php drawHeaderActivity("João Pinheiro", "comentou", $title, $date); ?>
        <p class="card-text"><?= $response ?></p>
    </div>

<?php
}

?>