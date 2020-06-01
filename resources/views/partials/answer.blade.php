<?php

$link_image = ($owner->photo != null) ? $owner->photo->url : null;

?>
@if($publication->visible)

<div class="py-2" id="{{$answer->id_commentable_publication}}">
    @include('activities.header_activity', ['memberId' => $owner->id_person, 'name' => $owner->name, "link_profile" => $link_image, 'action' => "", 'actionInBold' => "", "date" => $publication->date, "anonymous" => !$owner->person->visible, "banned" => !$owner->person->ban])    
    <p class="card-text"> {{ $publication->description }}</p>

    <div class="info row justify-content-end mx-0">
        @include('interation.info_content', ['type' => $answer])
    </div>

    
</div>



<div class="commentSection collapse" id=<?="commentSection".$answer->id_commentable_publication?>>
    @include('partials.comment_section', ['comments' => $answer->commentable_publication->comments, 'id_publication' => $answer->id_commentable_publication])
</div>

<hr class="section-break" />
@endif
