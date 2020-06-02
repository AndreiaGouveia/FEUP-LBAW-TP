<?php

$link_profile = ($question->publication->owner->photo) ? $question->publication->owner->photo->url : null;
?>

@if($question->publication->visible)
<div class="activity py-4 px-4 border-top">

    @include('activities.header_activity', ['memberId' => $question->publication->id_owner, 'name' => $question->publication->owner->name, "link_profile" => $link_profile, 'action' => "perguntou", 'actionInBold' => "", "date" => $question->publication->date, "anonymous" => !$question->publication->owner->person->visible, "banned" => $question->publication->owner->person->ban])

    <a href="{{ route('show.question', $question->id_commentable_publication) }}">
        <h5 class="title">{{ $question->title }}</h5>
    </a>
    <div class="description_inline">@markdown($question->publication->description)</div>
    <div class="row mt-4 px-0 mx-0">
        <div class="topics align-items-center">
            @foreach ($question->tags as $tag_question)
            @include('interation.tag', ['tag' => $tag_question->main_tag->name])
            @endforeach
        </div>
        <div class="info flex-fill d-flex justify-content-end mx-0">
            @include('interation.like_buttons', ['commentable_publication' => $question->commentable_publication, 'likes' => $question->commentable_publication->likes->count(), 'dislikes' => $question->commentable_publication->dislikes->count()])
        </div>

    </div>
</div>
@endif