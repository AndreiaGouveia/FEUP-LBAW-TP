<?php

use App\Response;

$commentable_publication = Response::find($reply->id_commentable_publication)->commentable_publication;
?>

<div class="activity py-4 px-4 border-top">
    @include('partials.header_activity', ['memberId' => $reply->memberId, 'name' => $reply->name, "link_profile" => $reply->url, 'action' => "respondeu a ", 'actionInBold' => $reply->title, "date" => $reply->date])
    <p class="text"><?= $reply->description ?></p>

    <div class="row mt-4 px-0 mx-0">
        <div class="info flex-fill d-flex justify-content-end mx-0">
            @include('partials.like_buttons', ['commentable_publication' => $commentable_publication, 'likes' => $reply->likes, 'dislikes' => $reply->dislikes])
        </div>
    </div>
</div>