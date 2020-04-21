<button class="btn px-2 py-0 comment-button" type="button" data-toggle="collapse" data-target="#commentSection{{ $commentable_publication->id_publication }}" aria-controls="commentSection{{ $commentable_publication->id_publication }}" aria-expanded="false" toggle="" data-placement="bottom" title="Deixe o seu comentário" aria-expanded="false" >
    <i class="far fa-comment"></i>
    <label style="margin-bottom: 0px" class="pl-1">Comentar</label>
</button>

@include('partials.like_buttons', ['likes' => $commentable_publication->likes->count(), 'dislikes' => $commentable_publication->dislikes->count()])

<div class="save-button ml-4">
    <button class="btn px-1 py-0" toggle="" data-placement="bottom" title="Guardar">
        <i class="far fa-star"></i>
    </button>
</div>

<div class="dropdown">
    <button class="btn px-1 py-0 ml-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-h"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Editar</a>
        <a class="dropdown-item" href="#">Eliminar</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" data-toggle="modal" data-target="#popUpReport{{ $commentable_publication->id_publication }}">Reportar</a>
    </div>
</div>

<?php /* report pop up missing */ ?>