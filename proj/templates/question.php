<?php
function drawQuestion()
{
?>

    <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed neque arcu. Nunc eu elementum purus. Vestibulum finibus maximus vestibulum. </h2>

    <div class="info">
        <?php drawInfoQuestion(); ?>
    </div>

    <div class="topics">
        <?php
        drawTopic("Lorem");
        drawTopic("Consectetur");
        drawTopic("Elementum");
        drawTopic("Donec");
        ?>
    </div>

    <div class="description">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed neque arcu. Nunc eu elementum purus. Vestibulum finibus maximus vestibulum. In hendrerit fermentum purus ut luctus. Aliquam pharetra mollis erat, non euismod felis varius in. Donec gravida cursus dui, sed egestas magna venenatis non. Curabitur in tellus eu diam varius tempus eget sit amet lorem. Nulla non consectetur magna, a tincidunt est. Sed posuere ex vel bibendum vehicula. Morbi egestas dolor magna, ullamcorper convallis nibh consequat eu. Sed ac venenatis odio. Phasellus convallis ipsum laoreet, tempus dui sed, euismod velit. Maecenas euismod nisi orci, ac tempor justo eleifend vel. Sed diam dui, commodo ornare convallis a, facilisis vitae eros.

            Nam accumsan turpis sit amet sem semper, vel sodales sapien pretium. Integer est felis, mollis sed tempor vitae, imperdiet ac nibh. Sed in cursus ligula, ac molestie velit. Suspendisse quis ultricies dui, eu mattis est. Curabitur sit amet magna ultrices magna consectetur tempor. Pellentesque venenatis ligula ut mollis pellentesque. Duis imperdiet ex vel nibh hendrerit, eu auctor mauris porta. Quisque in consectetur elit. Sed quis faucibus ante. Nullam est turpis, rhoncus non metus quis, dignissim bibendum quam.</p>
    </div>

<?php
}

function drawInfoQuestion()
{
?>
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
<?php
}

function drawTopic($topic)
{
?>

    <button class="topic btn-secondary btn-sm"><?=$topic?></button>

<?php
}
?>