<?php
function drawResponseSection()
{

?>

    <h5>3 responses</h5>

    <ul class="list-unstyled">
        <?php
        drawResponse("Mea sale accusam id. Sed eros corpora at. Justo definitionem sea at, eu unum vidit usu. Saepe voluptatum pro at. Possit pertinax argumentum mei in. An etiam alterum corpora sed, an impetus nominati his. Oratio nullam vidisse in nam.

        No dictas commune delicata eum. Ex feugiat omittam cum, vix ut hinc commune. Ut nec unum mazim tempor, pro eu simul conclusionemque. Dicant vituperata duo ad, ad wisi nullam vim, rebum oratio electram ei usu. Sed suas dicit possim id.", "No Qui Elit");

        drawResponse("Oporteat salutatus ne nec. Tractatos quaerendum ad sed. His praesent elaboraret no, munere singulis partiendo eam ex. Ad mucius ponderum est. Nisl primis concludaturque ne qui, facete assentior vix id. Cu eius instructior sed.

        Tota diceret erroribus et pri. Duo detraxit partiendo cu. Ei est alienum blandit. Mei saepe dicant iuvaret ut.
        
        Dicta appareat an eum, per ex alii similique.", "Sea Dicunt Oblique");

        drawResponse("Mea sale accusam id. Sed eros corpora at. Justo definitionem sea at, eu unum vidit usu. Saepe voluptatum pro at. Possit pertinax argumentum mei in. An etiam alterum corpora sed, an impetus nominati his. Oratio nullam vidisse in nam.", "No Qui Elit");
        ?>

    </ul>

    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">A tua Resposta</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Submit</button></div>
    </form>


<?php

}

function drawResponse($response, $author)
{

?>

    <hr class="section-break" />
    <li class="media">
        <img src="https://via.placeholder.com/64" class="align-self-start mr-3" alt="user image">
        <div class="media-body">
            <h5 class="mt-0"><?= $author ?></h5>
            <p><?= $response ?></p>
        </div>
    </li>

<?php
}

?>