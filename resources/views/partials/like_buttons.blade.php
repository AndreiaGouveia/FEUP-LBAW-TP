<?php 

use Illuminate\Support\Facades\Auth;

$likesPublication = false;
$dislikesPublication = false;

if(Auth::check()){

    $likesPublication = $commentable_publication->likesPub(Auth::user()->id);
    $dislikesPublication = $commentable_publication->dislikesPub(Auth::user()->id);

}
?>

<div class="like-buttons ml-4 btn-group btn-group-toggle" data-toggle="buttons" data-publication-id="{{ $commentable_publication->id_publication }}">
    <label class="btn btn-secondary px-1 py-0 like <?= $likesPublication ? "active" : "" ?>">
        <input type="radio" name="options" autocomplete="off">
        <i class="far fa-thumbs-up"></i>
        {{ $likes }}
    </label>
    <label class="btn btn-secondary px-1 py-0 ml-2 dislike <?= $dislikesPublication ? "active" : "" ?>">
        <input type="radio" name="options" autocomplete="off">
        <i class="far fa-thumbs-down"></i>
        {{ $dislikes }}
    </label>
</div>