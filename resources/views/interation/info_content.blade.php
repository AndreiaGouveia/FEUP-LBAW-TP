<?php

use Illuminate\Support\Facades\Auth;

$commentable_publication = $type->commentable_publication;

$favorite = false;
$owner = false;

if (Auth::check()) {

    $favorite = $commentable_publication->favoritePub(Auth::user()->id);
    $owner = $commentable_publication->publication->id_owner == Auth::user()->id;
}
?>

<button class="btn px-2 py-0 comment-button" type="button" data-toggle="collapse" data-target="#commentSection{{ $commentable_publication->id_publication }}" aria-controls="commentSection{{ $commentable_publication->id_publication }}" aria-expanded="false" toggle="" data-placement="bottom" title="Deixe o seu comentário" aria-expanded="false">
    <i class="far fa-comment"></i>
    <label style="margin-bottom: 0px" class="pl-1">Comentários</label>
</button>

@include('interation.like_buttons', ['commentable_publication' => $commentable_publication, 'likes' => $commentable_publication->likes->count(), 'dislikes' => $commentable_publication->dislikes->count()])

<div class="save-button ml-4 btn-group btn-group-toggle" data-toggle="buttons" data-publication-id="{{ $commentable_publication->id_publication }}">
    <label class="btn btn-secondary px-1 py-0 favorite <?= $favorite ? "active" : "" ?>" toggle="" data-placement="bottom" title="Guardar">
        <i class="far fa-star"></i>
        <input type="checkbox" name="save" id="save" autocomplete="off">
    </label>
</div>

<div class="dropdown">
    <button class="btn px-1 py-0 ml-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-h"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

        @if($owner)

            @if(get_class($type) == "App\Question")
                 <a class="dropdown-item" href="{{route('edit.question' , $commentable_publication->id_publication)}}">Editar</a>
            @elseif (get_class($type) == "App\Answer")
                 <a class="dropdown-item" href="#">Editar</a>
            @elseif (get_class($type) == "App\Comment")
                 <a class="dropdown-item" href="#">Editar</a>
            @endif

            <a class="dropdown-item" data-toggle="modal" data-target="#deletingPublicationPopUp{{ $commentable_publication->id_publication }}">Eliminar</a>
            <div class="dropdown-divider"></div>
        @else

            @isAdmin()
                <a class="dropdown-item" data-toggle="modal" data-target="#deletingPublicationPopUp{{ $commentable_publication->id_publication }}">Eliminar</a>
                <div class="dropdown-divider"></div>

            @else

                @isModerator()
                    <a class="dropdown-item" data-toggle="modal" data-target="#deletingPublicationPopUp{{ $commentable_publication->id_publication }}">Eliminar</a>
                    <div class="dropdown-divider"></div>
                @endisModerator

            @endisAdmin
        
        @endif
        <a class="dropdown-item" data-toggle="modal" data-target="#popUpReport{{ $commentable_publication->id_publication }}">Reportar</a>
    </div>
</div>

@include('interation.report_pop_up', ['idOfPopUp' => 'popUpReport' . $commentable_publication->id_publication, 'id_publication' => $commentable_publication->id_publication])
@include('interation.delete_pub_pop_up', ['idOfPopUp' => 'deletingPublicationPopUp' . $commentable_publication->id_publication, 'id_publication' => $commentable_publication->id_publication])