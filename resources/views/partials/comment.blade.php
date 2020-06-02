<?php

$link_image = ($comment->publication->owner->photo != null && $comment->publication->owner->person->visible && !$comment->publication->owner->person->ban) ?  $comment->publication->owner->photo->url : "images/default.png";
?>

<div class="p-2" id="{{$comment->id_publication}}">
    <img src="{{ $link_image }}" class="img-comment mr-2 mt-1" alt="">
    <div class="card comment-section">
        <div class="p-1">
            <p class="font-weight-bold d-inline">{{ $comment->publication->owner->person->ban ? "[Banned]" : ($comment->publication->owner->person->visible ? $comment->publication->owner->name : "[Anonymous]" )}}</p>
            <p class="d-inline">{{ $comment->publication->description }}</p>
        </div>
    </div>
</div>