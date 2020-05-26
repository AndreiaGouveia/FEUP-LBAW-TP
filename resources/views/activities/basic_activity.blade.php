<?php

use App\Question;

$commentable_publication = Question::find($question->id)->commentable_publication;
$publication = Question::find($question->id)->publication;
$visible = $publication->visible ;

?>
@if($visible)

<div class="activity py-4 px-4 border-top">

    @include('activities.header_activity', ['memberId' => $question->memberId, 'name' => $question->name, "link_profile" => $question->url, 'action' => "", 'actionInBold' => "", "date" => $question->date])

    <a href="{{ route('show.question', $question->id) }}">
        <h5 class="title"><?= $question->title  ?></h5>
    </a>
    <p class="text"><?= $question->description ?></p>


    <div class="row mt-4 px-0 mx-0">
        <div class="info row justify-content-start d-line mx-0">
            @each('interation.tag', json_decode($question->tags), 'tag')
        </div>
        <div class="info flex-fill d-flex justify-content-end mx-0">
            @include('interation.like_buttons', ['commentable_publication' => $commentable_publication, 'likes' => $commentable_publication->likes->count(), 'dislikes' => $commentable_publication->dislikes->count()])
        </div>

    </div>
</div>
@endif
