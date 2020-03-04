<?php
include_once("../templates/header.php");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <script src="https://kit.fontawesome.com/4f1925ab80.js" crossorigin="anonymous"></script>

    <title>Papagaio</title>
</head>



<body>
    <div class="header"> <?php drawHeaderVisitor();  ?> </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="profile_info">

                    <img src="..\profile_picture.png" width="300" height="300" class="d-inline-block align-center" alt="">
                    <h6><br></h6>
                    <div class="profile_data">
                        <h3>João Pinheiro<span class="badge badge-light"><i class="fas fa-shield-alt"></i></span></h3>
                        <h5><span class="badge badge-light"> <i class="fas fa-pencil-alt"></i> </span>Veterinário</h5>
                        <h5><span class="badge badge-light"> <i class="fas fa-map-marker-alt"></i> </span>Porto, Portugal</h5>
                        <h5><span class="badge badge-light"> <i class="fas fa-gem"></i> </span>1120 Pontos</h5>
                        <h5><br></h5>
                        <h4>Contribuições </h4>
                        <h5><span class="badge badge-light"> <i class="fas fa-question"></i> </span>120 Perguntas</h5>
                        <h5><span class="badge badge-light"> <i class="far fa-check-square"></i> </span>345 Respotas</h5>
                        <h5><span class="badge badge-light"> <i class="far fa-comment"></i></span>10 Comentários</h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="card">
                    <h5 class="card-header">No dia 04/03/2020 respondeu:</h5>
                    <div class="card-body">
                        <p class="card-text">Se o cachorro apenas parece triste, preste atenção se houve fatores recentes que possam ter desencadeado um quadro depressivo: você tem tido tempo para brincar com ele? A sua família tem dado atenção a ele? Há algum animal ou membro novo na família (ele pode estar com ciúmes)?</p>
                        <a href="#" class="btn btn-primary">Ver resposta completa</a>
                    </div>
                </div>

                <div class="card">
                    <h5 class="card-header">No dia 02/03/2020 perguntou:</h5>
                    <div class="card-body">
                        <h5 class="card-title">Qual o melhor sítio para passear o meu cão?</h5>
                        <p class="card-text">Mudei-me recentemente para a zona do Porto e gostava de saber qual o melhor sítio para levar o meu fiel amigo. Alguma sugestão?</p>
                        <a href="#" class="btn btn-primary">Ver pegunta completa</a>
                    </div>
                </div>

                <div class="card">
                    <h5 class="card-header">No dia 01/03/2020 comentou:</h5>
                    <div class="card-body">
                        <p class="card-text">Preciso de mais informação para responder a essa pergunta. À quanto tempo o seu animal está assim? É a primeira vez que isto acontece?</p>
                        <a href="#" class="btn btn-primary">Ver comentário completo.</a>
                    </div>
                </div>

                <div class="card">
                    <h5 class="card-header">No dia 29/02/2020 comentou:</h5>
                    <div class="card-body">
                        <p class="card-text">De certeza que tem dado o tipo de comida adequado ao seu animal? Que idade tem?</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>