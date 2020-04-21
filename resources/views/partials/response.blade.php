<div class="py-2">
    <?php drawHeaderActivity($author, "", "", "22/02/2020"); ?>
    <p class="card-text"><?= $response ?></p>
    <div class="info row justify-content-end mx-0">
        <?php drawInfoContent($idOfCommentSection); ?>
    </div>
</div>

<div class="commentSection collapse" id=<?= $idOfCommentSection ?>>
    <?php drawCommentSection(); ?>
</div>

<hr class="section-break" />