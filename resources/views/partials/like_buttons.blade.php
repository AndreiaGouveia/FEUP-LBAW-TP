<?php 

use Illuminate\Support\Facades\Auth;

$likesPublication = false;
$dislikesPublication = false;

if(Auth::check()){

    $likesPublication = count($commentable_publication->likes->where('id_member', '=', Auth::user()->id)) > 0;
    $dislikesPublication = count($commentable_publication->dislikes->where('id_member', '=', Auth::user()->id)) > 0;

}
?>

<div class="like-buttons ml-4 btn-group btn-group-toggle" data-toggle="buttons" data-publication-id="{{ $commentable_publication->id_publication }}">
    <label class="btn btn-secondary px-1 py-0 like <?= $likesPublication ? "active" : "" ?>" <?= $likesPublication ? "checked=\"true\"" : "" ?>>
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