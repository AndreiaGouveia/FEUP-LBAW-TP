<?php


use Illuminate\Support\Facades\Auth;

$link =  "https://i.stack.imgur.com/l60Hf.png";

/*if (Auth::check()) {
    $link = ($member->photo()->first() != null) ? $member->photo()->first()->url : $link;
}*/
?>

<div class="comment-block border-top pl-3 pt-2 pb-3">
    @each('partials.comment', $comments , 'comment')

    <form class="form-inline comment-box mt-3" name="comment-box{{ $id_publication }}">
        <input type="hidden" name="id_publication" value="{{ $id_publication }}">
        <img src="{{ $link }}" class="img-comment mr-2 mt-1" alt="">
        <input class="form-control flex-fill" name="comment_text" required="" type="text"></input>
        <button type="submit" class="btn btn-primary ml-1">Comentar</button>
    </form>
</div>