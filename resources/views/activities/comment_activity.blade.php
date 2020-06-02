<?php

$link_profile = ($comment->publication->owner->photo) ? $comment->publication->owner->photo->url : null;

$optionForCommentForAnswer = "";
$questionTitle = "";


if ($comment->commentsResponse != null) {
    $optionForCommentForAnswer = " uma resposta em ";
    $questionTitle = $comment->commentsResponse->question->title;

} else if($comment->commentsQuestion != null) {
    $questionTitle = $comment->commentsQuestion->title;
}
?>

@if($comment->publication->visible)
<div class="activity py-4 px-4 border-top">
    @include('activities.header_activity', ['memberId' => $comment->publication->id_owner, 'name' => $comment->publication->owner->name, "link_profile" => $link_profile, 'action' => "comentou " . $optionForCommentForAnswer . "", 'actionInBold' => $questionTitle, "date" => $comment->publication->date, "anonymous" => !$comment->publication->owner->person->visible, "banned" => $comment->publication->owner->person->ban])

    <p class="card-text">{{ $comment->publication->description }}</p>
</div>
@endif
