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
    <script src="https://kit.fontawesome.com/4f1925ab80.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <title>Papagaio</title>
</head>



<body>
    
    <?php drawHeaderVisitor();?>
     
    <form class="login">

        <div class="content">
            <label for="inputName"><i class="fas fa-user"></i></label>
            <input type="text" id="inputName" class="form-control" placeholder="Nome" required="" autofocus="">
        </div>

        <div class="content">
            <label for="inputEmail"><i class="fas fa-at"></i></label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="">
        </div>

        <div class="content">
            <label for="inputPassword"><i class="fas fa-key"></i></label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Palavra-passe" required="">
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="termsconds"> Eu aceito os termos e condições.
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registar</button>


        <hr class="section-break" />


        <a class="btn btn-outline-dark" href="/users/googleauth" role="button" style="text-transform:none">
            <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
            Registar com o Google
        </a>

    </form>
</body>

</html>