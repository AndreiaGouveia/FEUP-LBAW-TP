<?php

$link_image = ($owner->photo != null) ? $owner->photo->url : null;
?>

<div class="py-2">
    @include('partials.header_activity', ['name' => $owner->name, "link_profile" => $link_image, 'action' => "", 'actionInBold' => "", "date" => $answer->date])

    <p class="card-text"> {{ $answer->description }}</p>
    <div class="info row justify-content-end mx-0">
        <?php /* Info Comment Section */ ?>
    </div>
</div>

<div class="commentSection collapse" id="{{$answer->id}}">
    <?php /* Comment Section */ ?>
</div>

<hr class="section-break" />