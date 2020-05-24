<div class="form-group" >

    <form role="form" method="POST" action="{{ route('publication.destroy', ['id' => $id_publication ])}}">
        @csrf
        <!--SUPER DUPER IMPORTANTE-->

        <div class="modal fade" id="deletingPublicationPopUp" tabindex="-1" role="dialog" aria-labelledby="#{{ $idOfPopUp }}Label" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{ $idOfPopUp }}Label">Eliminar Publicação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <p class="px-3 my-2">Tem a certeza que quer eliminar a sua publicação?</p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Sim</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>