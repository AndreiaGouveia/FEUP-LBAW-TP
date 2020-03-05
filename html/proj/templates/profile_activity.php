<?php
function drawProfileActivity()
{
?>
    <div>
        <h3>Atividade recente </h3>

        <?php
        drawAnswerActivity();

        drawQuestionActivity();

        drawCommentActivity();

        ?>
    </div>
<?php

}

function drawQuestionActivity()
{
?>

    <div class="card">
        <h6 class="card-header">No dia 02/03/2020 perguntou:</h6>
        <div class="btn card-body">
            <p class="card-title">Qual o melhor sítio para passear o meu cão?</p>
            <p class="card-text">Mudei-me recentemente para a zona do Porto e gostava de saber qual o melhor sítio para levar o meu fiel amigo. Alguma sugestão?</p>
        </div>
    </div>
<?php
}

function drawAnswerActivity()
{
?>

    <div class="card">
        <h6 class="card-header">No dia 04/03/2020 respondeu:</h6>
        <div class="btn card-body">
            <p class="card-title">O meu gato anda muito triste, o que se passa?</p>
            <p class="card-text">Se o gato apenas parece triste, preste atenção se houve fatores recentes que possam ter desencadeado um quadro depressivo: você tem tido tempo para brincar com ele? A sua família tem dado atenção a ele? Há algum animal ou membro novo na família (ele pode estar com ciúmes)?</p>
        </div>
    </div>

<?php
}

function drawCommentActivity()
{

?>

    <div class="card">
        <h6 class="card-header">No dia 01/03/2020 comentou:</h6>
        <div class="btn card-body">
            <p class="card-title">Porque é que o meu gato não anda a comer?</p>
            <p class="card-text">Preciso de mais informação para responder a essa pergunta. À quanto tempo o seu animal está assim? É a primeira vez que isto acontece?</p>
        </div>
    </div>


<?php
}

?>