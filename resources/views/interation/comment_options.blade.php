<?php

use Illuminate\Support\Facades\Auth;

$owner = false;

if (Auth::check()) {

    $owner = $type->publication->id_owner == Auth::user()->id;
}
?>

<div class="dropdown">
    <button class="btn px-1 py-0 ml-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-h" aria-label="Mais Opcões"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

        @if($owner)
            <a class="dropdown-item" href="{{route('edit.comment' , $type->id_publication)}}">Editar</a>
            <a class="dropdown-item" data-toggle="modal" data-target="#deletingPublicationPopUp{{ $type->id_publication }}">Eliminar</a>
            <div class="dropdown-divider"></div>
        @else

            @isAdmin()
                <a class="dropdown-item" data-toggle="modal" data-target="#deletingPublicationPopUp{{ $type->id_publication }}">Eliminar</a>
                <div class="dropdown-divider"></div>

            @else

                @isModerator()
                    <a class="dropdown-item" data-toggle="modal" data-target="#deletingPublicationPopUp{{ $type->id_publication }}">Eliminar</a>
                    <div class="dropdown-divider"></div>
                @endisModerator

            @endisAdmin

        @endif
        
        @isAdmin()
        @else
        <a class="dropdown-item" data-toggle="modal" data-target="#popUpReport{{ $type->id_publication }}">Reportar</a>
        @endisAdmin
    </div>
</div>

@include('interation.report_pop_up', ['idOfPopUp' => 'popUpReport' . $type->id_publication, 'id_publication' => $type->id_publication])
@include('interation.delete_pub_pop_up', ['idOfPopUp' => 'deletingPublicationPopUp' . $type->id_publication, 'id_publication' => $type->id_publication])