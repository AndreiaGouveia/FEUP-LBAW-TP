<?php

$link_image = ($owner->photo != null) ? $owner->photo->url : null;
?>

<div class="py-2">
    @include('partials.header_activity', ['name' => $owner->name, "link_profile" => $link_image, 'action' => "", 'actionInBold' => "", "date" => $publication->date])    
    <p class="card-text"> {{ $publication->description }}</p>
    <div class="info row justify-content-end mx-0">
        @include('partials.info_content', ['commentable_publication' => $answer->commentable_publication ])
    </div>

    
</div>



<div class="commentSection collapse" id=<?="commentSection".$answer->id_commentable_publication?>>
    @include('partials.comment_section', ['comments' => $answer->commentable_publication->comments, 'id_publication' => $answer->id_commentable_publication])
</div>

<hr class="section-break" />