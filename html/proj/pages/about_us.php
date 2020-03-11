<?php
include_once("../templates/header.php");
include_once("../templates/main_page_questions.php");
include_once("../templates/topic.php");
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
    <link rel="stylesheet" type="text/css" href="../css/about.css">
    <script src="https://kit.fontawesome.com/4f1925ab80.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <title>Main Page</title>
</head>

<body>
    <?php drawHeaderMember(); ?>

    <div class="col-md-7 mx-auto">
        <div class=" mt-5">
            <h1 class="font-weight-normal mb-3">Sobre Nós</h1>
            <hr class="section-break" />

        </div>


        <div class=" mt-5" id="about-text">
            <p>
                O objetivo deste projeto foi desenvolver uma aplicação web de perguntas e respostas sobre animais.
                Esta aplicação consiste numa plataforma na qual todos os utilizadores podem deixar as suas perguntas e vê-las serem respondidas e/ou comentadas por outros membros da comunidade.
                Desta maneira, a aplicação suportar uma grande variedade de perguntas e repostas que satisfazem a curiosidade de todos os amantes de animais.
                Após uma breve pesquisa online, verificámos que apesar de já existirem diversos sites de perguntas e respostas, tanto gerais como específicos para o reino animal, existe uma falha no mercado de uma aplicação web deste género que seja user-friendly.
                Deste modo, resolvemos criar a nossa aplicação que consististe numa interface simples, mas muito completa, para que os utilizadores possam ver respondidas as suas curiosidades relativas ao reino animal.
            </p>
        </div>

        <div class="bg-transparent">
            <div class="py-5 ">
                <div class="row mb-4">
                    <div class="col-lg-5">
                        <h2 class="display-5 font-weight-light" style="font-size: 1.5rem;">A nossa equipa:</h2>
                    </div>
                </div>

                <div class="row text-center ">
                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5 ">
                        <div class="bg-white rounded shadow-sm py-5 px-4 border border-color-secondary"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834132/avatar-4_ozhrib.png"" alt="" width=" 100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Ana Filipa Senra</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>
                    <!-- End-->

                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5 ">
                        <div class="bg-white rounded shadow-sm py-5 px-4 border border-color-secondary">
                            <img src="https://res.cloudinary.com/mhmd/image/upload/v1556834130/avatar-3_hzlize.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Andreia Gouveia</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>
                    <!-- End-->

                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5 ">
                        <div class="bg-white rounded shadow-sm py-5 px-4 border border-color-secondary">
                            <img src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-2_f8dowd.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Cláudia Martins</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>
                    <!-- End-->

                    <!-- Team item-->
                    <div class="col-xl-3 col-sm-6 mb-5 ">
                        <div class="bg-white rounded shadow-sm py-5 px-4 border border-color-secondary"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-1_s02nlg.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                            <h5 class="mb-0">Margarida Pinho</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
                        </div>
                    </div>
                    <!-- End-->

                </div>
            </div>
        </div>

    </div>


    <?php drawFooter() ?>
</body>

</html>