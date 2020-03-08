<?php
include_once("../templates/header.php");
include_once("../templates/main_page_questions.php");
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
    <link rel="stylesheet" type="text/css" href="../css/main_page.css">
    <script src="https://kit.fontawesome.com/4f1925ab80.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <title>Main Page <(º^º)/</title>
</head>


<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<body>
    <?php drawHeaderMember();?>

    <div class="wellcome">
        <p>Bem-vindo à comunidade!</p>
    </div>

    <div class = "mainContent">
        <div class="content">
            <?php 
                drawMainPageQuestions();
            ?>
        </div>

        <div class="related">
                <h1>Tópicos Relacionados</h1>
                <button class="btn btn-secondary btn-sm px-2 py-0">Papagaio?</button>
                <button class="btn btn-secondary btn-sm px-2 py-0">Gatos</button>
                <button class="btn btn-secondary btn-sm px-2 py-0">Tartaruga maluca</button>
                <button class="btn btn-secondary btn-sm px-2 py-0">Gaivotas</button>
                <button class="btn btn-secondary btn-sm px-2 py-0">Ratos voadores</button>
                <button class="btn btn-secondary btn-sm px-2 py-0">Codv-19</button>
        </div>
    </div>



    <?php drawFooter(); ?>
</body>

</html>