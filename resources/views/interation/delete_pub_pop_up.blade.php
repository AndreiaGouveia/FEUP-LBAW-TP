
<div class="modal fade" id="{{ $idOfPopUp}}" tabindex="-1" role="dialog" aria-labelledby="#{{ $idOfPopUp }}Label" aria-hidden="true">
    <form class="modal-dialog modal-dialog-centered deletePub" role="document" data-publication-id="{{ $id_publication }}">
        <div class="modal-content px-3">
            <div class="modal-header mb-2">
                <h5 class="modal-title" id="{{ $idOfPopUp }}Label">Eliminar Conteúdo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p class="px-3 my-2">de certeza que quer eliminar a sua publicação?</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Submeter</button>
            </div>
        </div>
    </form>
</div>
