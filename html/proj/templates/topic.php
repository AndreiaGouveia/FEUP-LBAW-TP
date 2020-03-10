<?php

function drawTopic($topic)
{
?>

    <a class="btn btn-secondary btn-sm px-2 py-0 my-1" href="../pages/search_topic.php?search=<?= $topic ?>"><?= $topic ?></a>

<?php
}

function drawTopicSearch($topic)
{

?>
    <div class="py-3 px-4 border-top">
        <a class="btn btn-secondary" href="../pages/search_topic.php?search=<?= $topic ?>"><?= $topic ?></a>
    </div>

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

function drawTopicsInCard()
{

?>
    <div class="topics">
        <?php
        drawTopic("Lorem");
        drawTopic("Consectetur");
        drawTopic("Elementum");
        drawTopic("Donec");
        ?>

    </div>

<?php
}

?>