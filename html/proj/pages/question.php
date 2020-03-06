<?php
include_once("../templates/header.php");
include_once("../templates/question.php");
include_once("../templates/comment.php");
include_once("../templates/response.php");
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
    <link rel="stylesheet" type="text/css" href="../css/question.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script src="https://kit.fontawesome.com/4f1925ab80.js" crossorigin="anonymous"></script>

    <title>Question from a beardy</title>
</head>



<body>
    <div class="header"> <?php drawHeaderVisitor();  ?> </div>

    <div class="content">

        <div class="row">
            <div class="col-8">
                <?php drawQuestion(); ?>

                <hr class="section-break" />

                <div class="commentSection">
                    <?php drawCommentSection(); ?>
                </div>

                <div class="responseSection">
                    <?php drawResponseSection(); ?>
                </div>

            </div>
            <div class="sidebar col">

                <?php drawRecomendations(); ?>
            </div>

        </div>
    </div>

    <?php drawFooter(); ?>
</body>

</html>