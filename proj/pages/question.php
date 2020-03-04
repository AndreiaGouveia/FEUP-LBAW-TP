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
    <link rel="stylesheet" type="text/css" href="../css/question.css">
    <script src="https://kit.fontawesome.com/4f1925ab80.js" crossorigin="anonymous"></script>

    <title>Question from a beardy</title>
</head>



<body>
    <div class="header"> <?php drawHeaderVisitor();  ?> </div>

    <div class="content">

        <div class="col-8">
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed neque arcu. Nunc eu elementum purus. Vestibulum finibus maximus vestibulum. </h2>

            <div class="info">

                <p class="date">22/02/2020</p>

                <button type="radio" id="thumbs-up" name="votes">
                    <i class="far fa-thumbs-up"></i></button>
                <label for="thumbs-up">17</label>

                <button type="radio" id="thumbs-down" name="votes">
                    <i class="far fa-thumbs-down"></i></button>
                <label for="thumbs-down">7</label>

                <p class="author">Filipa S.</p>

                <button class="favorites" id="favorites">
                    <i class="far fa-star"></i></button>
                <label for="favorites">17</label>

            </div>

            <div class="topics">
                <button class="topic btn-secondary btn-sm">Lorem</button>
                <button class="topic btn-secondary btn-sm">Consectetur</button>
                <button class="topic btn-secondary btn-sm">Elementum</button>
                <button class="topic btn-secondary btn-sm">Donec</button>
            </div>

            <div class="description">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed neque arcu. Nunc eu elementum purus. Vestibulum finibus maximus vestibulum. In hendrerit fermentum purus ut luctus. Aliquam pharetra mollis erat, non euismod felis varius in. Donec gravida cursus dui, sed egestas magna venenatis non. Curabitur in tellus eu diam varius tempus eget sit amet lorem. Nulla non consectetur magna, a tincidunt est. Sed posuere ex vel bibendum vehicula. Morbi egestas dolor magna, ullamcorper convallis nibh consequat eu. Sed ac venenatis odio. Phasellus convallis ipsum laoreet, tempus dui sed, euismod velit. Maecenas euismod nisi orci, ac tempor justo eleifend vel. Sed diam dui, commodo ornare convallis a, facilisis vitae eros.

                    Nam accumsan turpis sit amet sem semper, vel sodales sapien pretium. Integer est felis, mollis sed tempor vitae, imperdiet ac nibh. Sed in cursus ligula, ac molestie velit. Suspendisse quis ultricies dui, eu mattis est. Curabitur sit amet magna ultrices magna consectetur tempor. Pellentesque venenatis ligula ut mollis pellentesque. Duis imperdiet ex vel nibh hendrerit, eu auctor mauris porta. Quisque in consectetur elit. Sed quis faucibus ante. Nullam est turpis, rhoncus non metus quis, dignissim bibendum quam.</p>
            </div>
        </div>
        <div class="sidebar col">

        </div>
    </div>
</body>

</html>