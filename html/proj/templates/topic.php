<?php

function drawTopic($topic)
{
?>

    <button class="btn btn-secondary btn-sm px-2 py-0"><?= $topic ?></button>

<?php
}

function drawRecommendationOfTopics()
{

?>

    <h6>Tópicos Relacionados</h6>
    <hr class="section-break" />
    <div>
        <?php 
        drawTopic("Papagaio?");
        drawTopic("Gatos");
        drawTopic("Tartaruga maluca");
        drawTopic("Gaivotas");
        drawTopic("Ratos Voadores");
        drawTopic("Codv-19");
        drawTopic("Gato reencarnação de Jesus");
        drawTopic("Cão Vegan");
        drawTopic("Hiena Vegan");
        drawTopic("Traumatismo");
        ?>
    </div>

<?php
}

?>