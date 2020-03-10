<?php

function drawCommentSection()
{
    $link = "..\images\profile_picture" .trim(rand(1,5)). ".png";
?>

    <div class="comment-block border-top pl-3 pt-2 pb-3">
        <?php
        drawComment("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.", "Someone famous");
        drawComment("Eruditi ornatus consectetuer no eam, ei qui ocurreret dissentias, velit laoreet ceteros ne ius. Aperiri nonumes inciderint sea et, simul argumentum an mea.", "His an Maiorum");
        drawComment("Aperiri nonumes inciderint sea et, simul argumentum an mea!!!", "Velit Laoreet");
        ?>

        <form class="form-inline mt-3">
            <img src=<?=$link?> class="img-comment mr-2 mt-1" alt="">
            <input class="form-control flex-fill" id="exampleFormControlTextarea1"></input>
            <button type="submit" class="btn btn-primary ml-1">Submit</button>
        </form>
    </div>

<?php
}

function drawComment($commment, $author)
{

    $link = "..\images\profile_picture" .trim(rand(1,5)). ".png";
?>
    <div class="p-2">
        <img src=<?=$link?> class="img-comment mr-2 mt-1" alt="">
        <div class="card comment-section">
            <div class="p-1">
            <p><?=$link?></p>
                <p class="font-weight-bold d-inline"><?= $author ?></p>
                <p class="d-inline"><?= $commment ?></p>
            </div>
        </div>
    </div>
<?php
}

?>