    <div>
        <h3 class="font-weight-normal mb-3">Atividade recente </h3>
        <?php
        $link = ($member->photo()->first() != null) ? $member->photo()->first()->url : "https://i.stack.imgur.com/l60Hf.png";

        foreach($info as $element){
            switch($element->type){
                case "question":
                    drawQuestionActivity($element->id_commentable_publication , $member->name , json_decode($element->tags), $element->likes , $element->dislikes ,  $element->date , $element->title , $element->description , $link);
                    break;

                case "comment":
                    drawCommentToQuestionActivity($element->id_commentable_publication , $member->name , $element->date , $element->id_commentable_publication , $element->description , $link);
                    break;

                case "commentreply":
                    drawCommentToAnswerActivity($element->id_commentable_publication, $member->name , $element->date , $element->id_commentable_publication , $element->description , $link);
                    break;

                case "reply":
                    drawAnswerActivity($element->id_commentable_publication , $member->name , $element->likes , $element->dislikes , $element->date , $element->title , $element->description , $link);
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

function drawTag($tag){
?>
    <a class="btn btn-secondary btn-sm px-2 py-0 my-1 mr-2" href="{{ route('search.topic', $tag) }}">{{ $tag }}</a>
<?php
}

function drawInfoBasicActivity($tags , $likes , $dislikes)
{
?>
    <div class="row mt-4 px-0 mx-0">
        <div class="info row justify-content-start d-line mx-0">
            <?php
                foreach($tags as $tag)
                {
                    if($tag != null)
                    drawTag($tag);
                }
            ?>
        </div>
        <div class="info flex-fill d-flex justify-content-end mx-0">
            <?php drawLikeButtons($likes , $dislikes); ?>
        </div>

    </div>
<?php
}

function drawLikeButtons($likes , $dislikes)
{

?>

    <div class="like-buttons ml-4">
        <button type="radio" class="btn px-1 py-0" toggle="" data-placement="bottom" title="Eu gosto disto">
            <i class="far fa-thumbs-up"></i>
            <label style="margin-bottom: 0px"><?=$likes?></label>
        </button>

        <button type="radio" class="btn px-1 py-0 ml-2" toggle="" data-placement="bottom" title="Eu não gosto disto">
            <i class="far fa-thumbs-down d-inline"></i>
            <label style="margin-bottom: 0px" class="d-inline"><?=$dislikes?></label>
        </button>
    </div>

<?php
}

function drawAnswerActivity($id , $name , $likes , $dislikes , $date, $title, $response , $link)
{
?>

    <a href="{{ route('show.question', $id) }}" class="hiperlink-in-activity">
        <div class="activity py-4 px-4 border-top ">
            <?php drawHeaderActivity($name, "respondeu a", $title, $date , $link); ?>
            <p class="card-text"><?= $response ?></p>
            <div class="info row justify-content-end align-items-center mx-0">
                <?php drawLikeButtons($likes , $dislikes); ?>
            </div>
        </div>
    </a>

<?php
}

function drawQuestionActivity($id , $name , $tags , $likes , $dislikes , $date, $title, $description , $link)
{
?>

    <a href="{{ route('show.question', $id) }}" class="hiperlink-in-activity">
        <div class="activity py-4 px-4 border-top">
            <?php drawHeaderActivity($name , "perguntou:", "", $date , $link); ?>
            <h5 class="title"><?= $title ?></h5>
            <p class="text"><?= $description ?></p>
            <?php drawInfoBasicActivity($tags , $likes , $dislikes); ?>
        </div>
    </a>

<?php
}

function drawCommentToAnswerActivity($id , $name , $date, $title, $response , $link)
{
?>

    <a href="{{ route('show.question', $id) }}" class="hiperlink-in-activity">
        <div class="activity py-4 px-4 border-top">
            <?php drawHeaderActivity($name, "comentou uma resposta a", $title, $date , $link); ?>
            <p class="card-text"><?= $response ?></p>
        </div>
    </a>

<?php
}

function drawCommentToQuestionActivity($id , $name , $date, $title, $response , $link)
{
?>

    <a href="{{ route('show.question', $id) }}" class="hiperlink-in-activity">
        <div href="../pages/question.php" class="activity py-4 px-4 border-top">
            <?php drawHeaderActivity($name , "comentou", $title, $date , $link); ?>
            <p class="card-text"><?= $response ?></p>
        </div>
    </a>

<?php
}

?>