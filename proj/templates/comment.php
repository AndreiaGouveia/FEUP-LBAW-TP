<?php

function drawCommentSection()
{
?>

    <?php
    drawComment("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.", "Someone famous");
    drawComment("Eruditi ornatus consectetuer no eam, ei qui ocurreret dissentias, velit laoreet ceteros ne ius. Aperiri nonumes inciderint sea et, simul argumentum an mea.", "His an Maiorum"); 
    drawComment("Aperiri nonumes inciderint sea et, simul argumentum an mea!!!", "Velit Laoreet"); 
    ?>

<?php
}

function drawComment($commment, $author)
{

?>

    <div class="comment card">
        <div class="comment">
            <p><?= $commment ?></p>
            <footer class="blockquote-footer"><?= $author ?></footer>
        </div>
    </div>

<?php
}

?>