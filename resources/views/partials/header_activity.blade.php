<?php
$link = (isset($link_profile)) ? $link_profile : "https://i.stack.imgur.com/l60Hf.png";
?>

<div id="header-card mb-3">
    <a href="{{ route('members', $memberId) }}"><img src=<?= $link ?> class="img_inside mr-2" alt=""></a>
    <div class="header-text">
    <a href="{{ route('members', $memberId) }}"><p class="name-and-action font-weight-bold d-inline"><?= $name ?></p></a>
        <p class="name-and-action d-inline"><?= $action ?></p>
        <p class="name-and-action font-weight-bold d-inline"><?= $actionInBold ?></p><br>
        <p><small><?= $date ?></small></p>
    </div>
</div>
</a>