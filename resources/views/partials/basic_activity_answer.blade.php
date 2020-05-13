<?php

use App\Response;

$commentable_publication = Response::find($answer->id_commentable_publication)->commentable_publication;
?>

<div class="activity py-4 px-4 border-top">
    @include('activities.header_activity', ['memberId' => $answer->memberId, 'name' => $answer->name, "link_profile" => $answer->url, 'action' => "respondeu a ", 'actionInBold' => $answer->title, "date" => $answer->date])
    <p class="text"><?= $answer->description ?></p>

    <div class="row mt-4 px-0 mx-0">
        <div class="info flex-fill d-flex justify-content-end mx-0">
            @include('partials.like_buttons', ['commentable_publication' => $commentable_publication, 'likes' => $answer->likes, 'dislikes' => $answer->dislikes])
        </div>
    </div>
</div>