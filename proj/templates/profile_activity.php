<?php
function drawProfileActivity()
{
?>
    <div>
        <?php
        drawQuestionActivity();
        drawCommentActivity();
        drawAnswerActivity();
        ?>
    </div>
<?php

}

function drawQuestionActivity()
{

?>

    <div class="card">
        <h5 class="card-header">No dia 02/03/2020 perguntou:</h5>
        <div class="card-body">
            <h5 class="card-title">Qual o melhor sítio para passear o meu cão?</h5>
            <p class="card-text">Mudei-me recentemente para a zona do Porto e gostava de saber qual o melhor sítio para levar o meu fiel amigo. Alguma sugestão?</p>
            <a href="#" class="btn btn-primary">Ver pegunta completa</a>
        </div>
    </div>
<?php
}

function drawAnswerActivity()
{
?>

    <div class="card">
        <h5 class="card-header">No dia 04/03/2020 respondeu:</h5>
        <div class="card-body">
            <p class="card-text">Se o cachorro apenas parece triste, preste atenção se houve fatores recentes que possam ter desencadeado um quadro depressivo: você tem tido tempo para brincar com ele? A sua família tem dado atenção a ele? Há algum animal ou membro novo na família (ele pode estar com ciúmes)?</p>
            <a href="#" class="btn btn-primary">Ver resposta completa</a>
        </div>
    </div>

<?php
}

function drawCommentActivity()
{

?>

    <div class="card">
        <h5 class="card-header">No dia 01/03/2020 comentou:</h5>
        <div class="card-body">
            <p class="card-text">Preciso de mais informação para responder a essa pergunta. À quanto tempo o seu animal está assim? É a primeira vez que isto acontece?</p>
            <a href="#" class="btn btn-primary">Ver comentário completo</a>
        </div>
    </div>


<?php
}

?>