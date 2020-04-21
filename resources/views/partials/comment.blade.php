<?php

$link_image = ($comment->publication->owner->photo != null) ? $comment->publication->owner->photo->url : "https://i.stack.imgur.com/l60Hf.png";
?>

<div class="p-2">
    <img src="{{ $link_image }}" class="img-comment mr-2 mt-1" alt="">
    <div class="card comment-section">
        <div class="p-1">
            <p class="font-weight-bold d-inline">{{ $comment->publication->owner->name }}</p>
            <p class="d-inline">{{ $comment->publication->description }}</p>
        </div>
    </div>
</div>