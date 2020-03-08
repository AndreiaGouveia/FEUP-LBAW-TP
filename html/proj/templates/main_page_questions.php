<?php

include_once("profile_activity.php");

function drawMainPageQuestions()
{
?>
    <div>
        <h3 class="font-weight-normal mb-3">Questões Populares </h3>
        <?php
        drawMainPageQuestion("12/03/2020", "Porque é que o meu pássaro não gosta de papagaios?", "Não concordo com este comportamento! Cuidado!");
        drawMainPageQuestion("28/03/2020", "Quantos grãos de aveia consegue um gato comer", "Não concordo com esta resposta! Cuidado!");
        drawMainPageQuestion("04/03/2020", "O meu gato anda muito triste, o que se passa?", "Se o gato apenas parece triste, preste atenção se houve fatores recentes que possam ter desencadeado um quadro depressivo: você tem tido tempo para brincar com ele? A sua família tem dado atenção a ele? Há algum animal ou membro novo na família (ele pode estar com ciúmes)?");
        drawMainPageQuestion("02/03/2020", "Quantos grãos de aveia consegue um gato comer", "Não concordo com esta resposta! Cuidado!");
        drawMainPageQuestion("02/03/2020", "Qual o melhor sítio para passear o meu cão?", "Se o gato apenas parece triste, preste atenção se houve fatores recentes que possam ter desencadeado um quadro depressivo: você tem tido tempo para brincar com ele? A sua família tem dado atenção a ele? Há algum animal ou membro novo na família (ele pode estar com ciúmes)?");
        drawMainPageQuestion("02/02/2020", "Quantos grãos de aveia consegue um gato comer", "Não concordo com esta resposta! Cuidado!");
        drawMainPageQuestion("01/01/2020", "Porque é que o meu gato não anda a comer?", "O seu gato tem andando triste? Poderá ser um motivo...");

        ?>
    </div>
<?php

}

function drawMainPageQuestion($date, $title, $description)
{
?>
    <div href="#" class="activity py-4 px-4 border-top">
        <?php drawHeaderActivity("João Pinheiro", "", "", $date); ?>
        <h5 class="title"><?= $title ?></h5>
        <p class="text"><?= $description ?></p>
    </div>

<?php

}


?>