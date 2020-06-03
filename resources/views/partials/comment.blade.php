<?php

$link = ($comment->publication->owner->photo != null && $comment->publication->owner->person->visible && !$comment->publication->owner->person->ban) ?  $comment->publication->owner->photo->url : "images/default.png";
?>

<div class="p-2" id="{{$comment->id_publication}}">
    <img src='{{asset("storage/$link")}}' class="img-comment mr-2 mt-1" alt="profilePic">
    <div class="card comment-section">
        <div class="p-1 d-flex justify-content-between">
        <div>
            <p class="font-weight-bold d-inline">{{ $comment->publication->owner->person->ban ? "[Banned]" : ($comment->publication->owner->person->visible ? $comment->publication->owner->name : "[Anonymous]" )}}</p>
            <p class="d-inline">{{ $comment->publication->description }}</p>
        </div>
            <div class="info row justify-content-end align-items-center mx-0" data-publication-id="{{ $comment->id_commentable_publication }}">
            @include('interation.comment_options', ['type' => $comment])
           </div>
        </div>
    </div>
</div>