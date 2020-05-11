<div>
    <?php
    $link = ($member->photo()->first() != null) ? $member->photo()->first()->url : "https://i.stack.imgur.com/l60Hf.png";

    foreach ($info as $element) {
        if ($element->type == "reply") {
            drawAnswerActivity($element->id_question, $member->name, $element->likes, $element->dislikes, $element->date, $element->title, $element->description, $link);
        }
    }
    ?>
</div>

<?php

function drawAnswerActivity($id, $name, $likes, $dislikes, $date, $title, $response, $link)
{
?>
    <div class="activity py-4 px-4 border-top ">
        <?php drawHeaderActivity($id, $name, "respondeu a", $title, $date, $link); ?>
        <p class="card-text"><?= $response ?></p>
        <div class="info row justify-content-end align-items-center mx-0">
            <?php drawLikeButtons($likes, $dislikes); ?>
        </div>
    </div>

<?php
}
