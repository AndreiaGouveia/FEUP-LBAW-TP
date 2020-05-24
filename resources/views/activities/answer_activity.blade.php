<?php

$link_profile = ($answer->publication->owner ) ? $answer->publication->owner->url : null;

?>
<div class="activity py-4 px-4 border-top ">
    @include('activities.header_activity', ['memberId' => $answer->publication->id_owner, 'name' => $answer->publication->owner->name, "link_profile" => $link_profile, 'action' => "respondeu a ", 'actionInBold' => $answer->question->title, "date" => $answer->publication->date, "anonymous" => !$answer->publication->owner->person->visible])

    <p class="card-text">{{ $answer->publication->description }}</p>

    <div class="info row justify-content-end align-items-center mx-0">
        @include('interation.like_buttons', ['commentable_publication' => $answer->commentable_publication, 'likes' => $answer->commentable_publication->likes->count(), 'dislikes' => $answer->commentable_publication->dislikes->count()])
    </div>

</div>