<?php

include_once("../templates/profile_activity.php");
function drawResponseSection()
{

?>
    <h5>3 respostas</h5>

    <hr class="section-break" />
    <ul class="list-unstyled">
        <?php
        drawResponse("Duvido que exista um animal que não possa ser domesticado com esforço, mas alguns são certamente mais fáceis que outros. Aqui estão algumas características que facilitam a domesticação: Rápida taxa de crescimento. Os animais que crescem e amadurecem rapidamente são mais fáceis de criar seletivamente e são mais lucrativos para os agricultores. Resistente / flexível. Os seres humanos nem sempre são cuidadores confiáveis, de modo que os animais domésticos geralmente são capazes de sobreviver em uma ampla variedade de condições, comer lixo e ficar sem comida ou água por algum tempo. Social. Os agricultores normalmente criam animais em grupos, de modo que os animais domésticos precisam se sentir confortáveis ​​com isso para se reproduzir bem em cativeiro. Mente em grupo. Os animais que seguem o rebanho são fáceis de controlar, como todo político sabe. Baixo medo. As espécies nervosas são facilmente estressadas em cativeiro, tornando-as suscetíveis a doenças, lentas para crescer e difíceis de procriar. Baixa agressão. O combate diminui a produtividade e pode colocar em risco o agricultor. Aprendendo. Animais que lembram rotinas e respondem ao treinamento são fáceis de gerenciar.", 
            "Suzanne Sadedin", "responseCommentSection1");

        drawResponse("Cerca de 11.000 anos atrás, os humanos perceberam que havia um lugar melhor para alguns animais do que a outra ponta de uma lança. Começamos a convencê-los a nossos assentamentos, gradualmente moldando sua natureza para melhor atender às nossas necessidades de comida, trabalho e companhia. Ao longo dos milênios, nos envolvemos com a domesticação de muitas espécies. Mas apenas alguns - mais notavelmente, vaca, cabra, ovelha, galinha, cavalo, porco, cachorro e gato - se mostraram tão úteis que percorreram o mundo todo, florescendo em quase todos os lugares que os humanos fazem. Mas por que apenas esses animais? Por que não o rinoceronte, o tigre, a zebra ou qualquer uma das centenas de outras criaturas aparentemente adequadas que não foram cortadas e, consequentemente, foram relegados a uma parcela cada vez menor da terra e dos recursos da Terra? Segundo o fisiologista e geógrafo evolucionista Jared Diamond, em seu aclamado livro 'Guns, Germs and Steel' (Norton, 1997), existem seis critérios que os animais devem atender para domesticação. Muitas espécies chegam perto, mas muito poucas são adequadas. Primeiro, os animais domésticos não podem ser comedores exigentes; eles devem ser capazes de encontrar comida suficiente dentro e ao redor dos assentamentos humanos para sobreviver. Os herbívoros, como vacas e ovelhas, devem poder forragear a grama e comer nossos suprimentos excedentes de grãos. Carnívoros, como cães e gatos, devem estar dispostos a vasculhar restos e sobras de seres humanos, bem como os vermes que esses pedaços atraem.", 
        "Natalie Wolchover", "responseCommentSection2");
        drawResponse("Cães, ovelhas, porcos, vacas, cavalos - todos esses animais e muito mais foram fundamentalmente alterados pelos seres humanos para melhorar nossa vida. A domesticação alterou fundamentalmente o curso da história humana, remodelando a terra e outras espécies para se adequar ao nosso novo estilo de vida agrícola. Mas como você pega uma espécie selvagem e a transforma em ajudante domesticado? Por que animais como cães ou cavalos podem ser domesticados enquanto seus parentes próximos, como raposas e zebras, permanecem teimosamente selvagens? O que é domesticação? A domesticação ocorre quando os seres humanos tomam uma planta ou espécie animal e, através de criação seletiva, transformam a espécie em algo benéfico para os seres humanos. Historicamente, houve três razões principais pelas quais os humanos domesticam. O primeiro é criar uma fonte pronta de alimento, como pegar os ancestrais selvagens das vacas e transformá-los em gado. O segundo é aproveitar os animais para o trabalho, que pode variar do transporte ao uso na guerra, sendo os cavalos o exemplo mais óbvio disso. Depois, há a domesticação que cria animais de estimação e companheiros para os seres humanos - os cães são um ótimo exemplo disso.",
         "Alasdair Wilkins", "responseCommentSection3");
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