<?php

function drawCommentSection()
{
?>

    <div class="comment-block border-top pl-3 pt-2 pb-3">
        <?php
        drawComment("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.", "Someone famous");
        drawComment("Eruditi ornatus consectetuer no eam, ei qui ocurreret dissentias, velit laoreet ceteros ne ius. Aperiri nonumes inciderint sea et, simul argumentum an mea.", "His an Maiorum");
        drawComment("Aperiri nonumes inciderint sea et, simul argumentum an mea!!!", "Velit Laoreet");
        ?>
    </div>
<?php
}

function drawComment($commment, $author)
{

?>
    <div class="p-2">
        <img src="..\profile_picture.png" class="img-comment mr-2 mt-1" alt="">
        <div class="card comment-section">
            <div class="p-1">
                <p class="font-weight-bold d-inline"><?= $author ?></p>
                <p class="d-inline"><?= $commment ?></p>
            </div>
        </div>
    </div>
<?php
}

?>