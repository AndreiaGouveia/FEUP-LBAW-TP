<?php

include_once("../templates/profile_activity.php");
function drawResponseSection()
{

?>
    <h5>3 respostas</h5>

    <hr class="section-break" />
    <ul class="list-unstyled">
        <?php
        drawResponse("Tal como a nossa alimentação existem certos ingredientes que as comidas processadas têm que não ajudam o nosso metabolismo e que nos podem prejudicar. No entanto, e apesar de mais caras, existem marcas de ração com ingredientes mais saudáveis e sem cereais por exemplo. 
        A gama Beyond da Purina é espetacular e a minha miúda adora!","Ines","responseCommentSection1");

        drawResponse("A ração humida é que faz mal","Mateus","responseCommentSection2");

        drawResponse("Não. Os veterinários aconselham a seca. Mas tem de ser de boa qualidade porque, as marcas brancas, as whiskas e as friskies não são recomendadas pelos vets.
        Tenho 2 gatos, comem Royal Canin e estão mt bem. É melhor gastar mais na ração do que depois, no veterinário...","Luisa","responseCommentSection3");
        ?>

    </ul>
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">A tua Resposta</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Responder</button></div>
    </form>


<?php

}

function drawResponse($response, $author, $idOfCommentSection)
{
?>
    <div class="py-2">
        <?php drawHeaderActivity($author, "", "", "22/02/2020"); ?>
        <p class="card-text"><?= $response ?></p>
        <div class="info row justify-content-end mx-0">
            <?php drawInfoContent($idOfCommentSection); ?>
        </div>
    </div>

    <div class="commentSection collapse" id=<?=$idOfCommentSection?>>
        <?php drawCommentSection(); ?>
    </div>
    
    <hr class="section-break" />


<?php
}

?>