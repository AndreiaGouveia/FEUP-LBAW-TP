<div>
    <?php
    $link = ($member->photo()->first() != null) ? $member->photo()->first()->url : "https://i.stack.imgur.com/l60Hf.png";

    foreach ($info as $element) {
        if ($element->type == "comment") {
            drawCommentToQuestionActivity($element->id_commentable_publication, $member->name, $element->date, $element->commentable_publication, $element->description, $link);
        } else if ($element->type == "commentreply") {
            drawCommentToAnswerActivity($element->id_commentable_publication, $member->name, $element->date, $element->commentable_publication, $element->description, $link);
        }
    }

    ?>
</div>

<?php

function drawCommentToAnswerActivity($id, $name, $date, $title, $response, $link)
{
?>
    <div class="activity py-4 px-4 border-top">
        <?php drawHeaderActivity($id, $name, "comentou uma resposta a", $title, $date, $link); ?>
        <p class="card-text"><?= $response ?></p>
    </div>

<?php
}

function drawCommentToQuestionActivity($id, $name, $date, $title, $response, $link)
{
?>

    <div class="activity py-4 px-4 border-top">
        <?php drawHeaderActivity($id, $name, "comentou", $title, $date, $link); ?>
        <p class="card-text"><?= $response ?></p>
    </div>

<?php
}

?>