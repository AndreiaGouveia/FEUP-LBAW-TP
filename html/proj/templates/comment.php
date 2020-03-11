<?php

function drawCommentSection()
{
?>

    <div class="comment-block border-top pl-3 pt-2 pb-3">
        <?php
        drawComment("Nunca pensei nisso! Ótima resposta!", "Carl Linnaeus");
        drawComment("Não sei se concordo com tudo, mas bom esforço!", "Charles Darwin");
        drawComment("Eu amo isto! Uma informação fantástica. Certamente que vou investigar mais sobre este assunto. Leitura incrível.
        Fico à espera de o ver mais pelo maravilhoso site 'Papagaio'!", "Alfred Russel Wallace");
        ?>

        <form class="form-inline mt-3">
            <img src="..\profile_picture.png" class="img-comment mr-2 mt-1" alt="">
            <input class="form-control flex-fill" id="exampleFormControlTextarea1"></input>
            <button type="submit" class="btn btn-primary ml-1">Submit</button>
        </form>
    </div>

<?php
}

function drawComment($commment, $author)
{

?>
    <div class="p-2">
        <img src="..\profile_picture.png" class="img-comment mr-2 mt-1" alt="">
        <div class="card comment-section">
            <div class="p-1">
                <p class="font-weight-bold d-inline"><?= $author ?></p>
                <p class="d-inline"><?= $commment ?></p>
            </div>
        </div>
    </div>
<?php
}

?>