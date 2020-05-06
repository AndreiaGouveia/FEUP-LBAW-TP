    <div>
        <h3 class="font-weight-normal mb-3">Atividade recente </h3>
        <?php
        $link = ($member->photo()->first() != null) ? $member->photo()->first()->url : "https://i.stack.imgur.com/l60Hf.png";
        var_dump(count($info));

        foreach($info as $element){
            switch($element->type){
                case "question":
                    drawQuestionActivity($element->date , $element->title , $element->description , $link);
                    break;

                case "comment":
                    drawCommentToQuestionActivity($element->date , $element->id_commentable_publication , $element->description , $link);
                    break;

                case "commentreply":
                    drawCommentToAnswerActivity($element->date , $element->id_commentable_publication , $element->description , $link);
                    break;

                case "reply":
                    drawAnswerActivity($element->date , $element->title , $element->description , $link);
                    break;
            }
        }
        ?>
    </div>

<?php
function drawHeaderActivity($name, $action, $actionInBold, $date , $link)
{
?>

    <div id="header-card mb-3">
        <img src=<?= $link ?> class="img_inside mr-2" alt="">
        <div class="header-text">
            <p class="name-and-action font-weight-bold d-inline"><?= $name ?></p>
            <p class="name-and-action d-inline"><?= $action ?></p>
            <p class="name-and-action font-weight-bold d-inline"><?= $actionInBold ?></p><br>
            <p><small><?= $date ?></small></p>
        </div>
    </div>

<?php
}


function drawBasicActivity($date, $title, $description , $link)
{
?>
    <a href="../pages/question.php" class="hiperlink-in-activity">
        <div class="activity py-4 px-4 border-top">

            <?php drawHeaderActivity("João Pinheiro", "", "", $date , $link); ?>
            <h5 class="title"><?= $title ?></h5>
            <p class="text"><?= $description ?></p>
            <?php drawInfoBasicActivity(); ?>
        </div>
    </a>

<?php

}

function drawInfoBasicActivity()
{
?>
    <div class="row mt-4 px-0 mx-0">
        <div class="info row justify-content-start d-line mx-0">
            <?php //drawTopicsInCard(); ?>
        </div>
        <div class="info flex-fill d-flex justify-content-end mx-0">
            <?php drawLikeButtons(); ?>
        </div>

    </div>
<?php
}

function drawLikeButtons()
{

?>

    <div class="like-buttons ml-4">
        <button type="radio" class="btn px-1 py-0" toggle="" data-placement="bottom" title="Eu gosto disto">
            <i class="far fa-thumbs-up"></i>
            <label style="margin-bottom: 0px">17</label>
        </button>

        <button type="radio" class="btn px-1 py-0 ml-2" toggle="" data-placement="bottom" title="Eu não gosto disto">
            <i class="far fa-thumbs-down d-inline"></i>
            <label style="margin-bottom: 0px" class="d-inline">7</label>
        </button>
    </div>

<?php
}

function drawAnswerActivity($date, $title, $response , $link)
{
?>

    <a href="../pages/question.php" class="hiperlink-in-activity">
        <div class="activity py-4 px-4 border-top ">
            <?php drawHeaderActivity("João Pinheiro", "respondeu a", $title, $date , $link); ?>
            <p class="card-text"><?= $response ?></p>
            <div class="info row justify-content-end align-items-center mx-0">
                <?php drawLikeButtons(); ?>
            </div>
        </div>
    </a>

<?php
}

function drawQuestionActivity($date, $title, $description , $link)
{
?>


    <a href="../pages/question.php" class="hiperlink-in-activity">
        <div class="activity py-4 px-4 border-top">
            <?php drawHeaderActivity("João Pinheiro", "perguntou:", "", $date , $link); ?>
            <h5 class="title"><?= $title ?></h5>
            <p class="text"><?= $description ?></p>
            <?php drawInfoBasicActivity(); ?>
        </div>
    </a>

<?php
}

function drawCommentToAnswerActivity($date, $title, $response , $link)
{
?>


    <a href="../pages/question.php" class="hiperlink-in-activity">
        <div class="activity py-4 px-4 border-top">
            <?php drawHeaderActivity("João Pinheiro", "comentou uma resposta a", $title, $date , $link); ?>
            <p class="card-text"><?= $response ?></p>
        </div>
    </a>

<?php
}

function drawCommentToQuestionActivity($date, $title, $response , $link)
{
?>


    <a href="../pages/question.php" class="hiperlink-in-activity">
        <div href="../pages/question.php" class="activity py-4 px-4 border-top">
            <?php drawHeaderActivity("João Pinheiro", "comentou", $title, $date , $link); ?>
            <p class="card-text"><?= $response ?></p>
        </div>
    </a>

<?php
}

?>