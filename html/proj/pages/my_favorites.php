<?php
include_once("../templates/header.php");
include_once("../templates/search.php");
include_once("../templates/footer.php");

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/settings.css">
    <link rel="stylesheet" type="text/css" href="../css/search.css">
    <link rel="stylesheet" type="text/css" href="../css/main_page.css">
    <script src="https://kit.fontawesome.com/4f1925ab80.js" crossorigin="anonymous"></script>
    <script src="../js/search.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <title>Os meus favoritos</title>

</head>

<body>
    <?php drawHeaderMember(); ?>

    <div class="col-md-7 mx-auto mt-5">
        <div class="container row flex-lg-row">
            <div class="mb-3">
                <h2 class="font-weight-normal d-inline">Os meus favoritos</h2>
            </div>

            <div class="row container justify-content-between mb-4">
                <div class="list-group list-group-horizontal mb-2" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active py-2" id="list-questions-list" data-toggle="list" href="#list-questions" role="tab" aria-controls="questions">Perguntas</a>
                    <a class="list-group-item list-group-item-action py-2" id="list-responses-list" data-toggle="list" href="#list-responses" role="tab" aria-controls="topics">Respostas</a>
                </div>
                <select class="custom-select">
                    <option selected>Revelante</option>
                    <option value="1">Recente</option>
                    <option value="2">Mais Votados</option>
                    <option value="3">Menos Votados</option>
                </select>
            </div>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-questions" role="tabpanel" aria-labelledby="list-questions-list"><?php drawSearchContentQuestions(); ?></div>
                <div class="tab-pane fade" id="list-responses" role="tabpanel" aria-labelledby="list-responses-list"><?php drawSearchContentQuestions(); ?></div>
            </div>
            <?php

            ?>
        </div>
    </div>


    <?php drawFooter(); ?>
</body>

<script>
    setUpSearch("<?= $search_query ?>");
</script>

</html>