<?php

include_once("profile_activity.php");

function drawSearchTopics($search_query)
{

?>
    <div>
        <div class="mb-3">
            <h2 class="font-weight-normal text-secondary d-inline">Resultados de Pesquisa para Perguntas com o Tópico </h2>
            <h2 class="d-inline"><?= $search_query ?></h2>
        </div>

        <div class="d-flex justify-content-end mb-4 ">
            <select class="custom-select">
                <option selected>Revelante</option>
                <option value="1">Recente</option>
                <option value="2">Mais Votados</option>
                <option value="3">Menos Votados</option>
            </select>
        </div>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-questions" role="tabpanel" aria-labelledby="list-questions-list"><?php drawSearchContentQuestions(); ?></div>
            <div class="tab-pane fade" id="list-topics" role="tabpanel" aria-labelledby="list-topics-list"><?php drawSearchContentTopics(); ?></div>
        </div>
        <?php

        ?>
    </div>
<?php
}

function drawSearchQuestions($search_query)
{
?>
    <div>
        <div class="mb-3">
            <h2 class="font-weight-normal text-secondary d-inline">Resultados de Pesquisa para </h2>
            <h2 class="d-inline"><?= $search_query ?></h2>
        </div>

        <div class="row container justify-content-between mb-4">
            <div class="list-group list-group-horizontal mb-2" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active py-2" id="list-questions-list" data-toggle="list" href="#list-questions" role="tab" aria-controls="questions">Perguntas</a>
                <a class="list-group-item list-group-item-action py-2" id="list-topics-list" data-toggle="list" href="#list-topics" role="tab" aria-controls="topics">Tópicos</a>
            </div>
            <select class="custom-select">
                <option selected>Revelante</option>
                <option value="1">Recente</option>
                <option value="2">Mais Votados</option>
                <option value="3">Menos Votados</option>
            </select>
        </div>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-questions" role="tabpanel" aria-labelledby="list-questions-list"><?php drawSearchContentQuestions(); ?></div>
            <div class="tab-pane fade" id="list-topics" role="tabpanel" aria-labelledby="list-topics-list"><?php drawSearchContentTopics(); ?></div>
        </div>
        <?php

        ?>
    </div>
<?php

}

function drawSearchContentQuestions()
{
    drawBasicActivity("12/03/2020", "Porque é que o meu pássaro não gosta de papagaios?", "Não concordo com este comportamento! Cuidado!");
    drawBasicActivity("28/03/2020", "Quantos grãos de aveia consegue um gato comer", "Não concordo com esta resposta! Cuidado!");
    drawBasicActivity("04/03/2020", "O meu gato anda muito triste, o que se passa?", "Se o gato apenas parece triste, preste atenção se houve fatores recentes que possam ter desencadeado um quadro depressivo: você tem tido tempo para brincar com ele? A sua família tem dado atenção a ele? Há algum animal ou membro novo na família (ele pode estar com ciúmes)?");
    drawBasicActivity("02/03/2020", "Quantos grãos de aveia consegue um gato comer", "Não concordo com esta resposta! Cuidado!");
    drawBasicActivity("02/03/2020", "Qual o melhor sítio para passear o meu cão?", "Se o gato apenas parece triste, preste atenção se houve fatores recentes que possam ter desencadeado um quadro depressivo: você tem tido tempo para brincar com ele? A sua família tem dado atenção a ele? Há algum animal ou membro novo na família (ele pode estar com ciúmes)?");
    drawBasicActivity("02/02/2020", "Quantos grãos de aveia consegue um gato comer", "Não concordo com esta resposta! Cuidado!");
    drawBasicActivity("01/01/2020", "Porque é que o meu gato não anda a comer?", "O seu gato tem andando triste? Poderá ser um motivo...");
}

function drawSearchContentTopics()
{
    drawTopicSearch("Papagaio?");
    drawTopicSearch("Gatos");
    drawTopicSearch("Tartaruga maluca");
    drawTopicSearch("Gaivotas");
    drawTopicSearch("Ratos Voadores");
    drawTopicSearch("Codv-19");
    drawTopicSearch("Gato reencarnação de Jesus");
    drawTopicSearch("Cão Vegan");
    drawTopicSearch("Hiena Vegan");
    drawTopicSearch("Traumatismo");
}

?>