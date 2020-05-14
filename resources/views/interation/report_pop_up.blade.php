<div class="modal fade" id="{{ $idOfPopUp}}" tabindex="-1" role="dialog" aria-labelledby="#{{ $idOfPopUp }}Label" aria-hidden="true">
    <form class="modal-dialog modal-dialog-centered report" role="document" data-publication-id="{{ $id_publication }}">
        <div class="modal-content px-3">
            <div class="modal-header mb-2">
                <h5 class="modal-title" id="{{ $idOfPopUp }}Label">Reportar Conteúdo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="mb-2 px-2 content">
                @include('interation.report_radio_button', ['content' => "Spam ou conteúdo enganoso", 'value' => 'Spam'])
                @include('interation.report_radio_button', ['content' => "Conteúdo abusivo/incitação ao ódio", 'value' => 'Hate speach']) 
                @include('interation.report_radio_button', ['content' => "Terrorismo", 'value' => 'Terrorism' ])
                @include('interation.report_radio_button', ['content' => "Dispersão de Notícias Falsas", 'value' =>  'Fake News' ])
                @include('interation.report_radio_button', ['content' => "Vendas Ilegais", 'value' => 'Illegal Sales'])
                @include('interation.report_radio_button', ['content' => "Conteúdo violento ou repulsivo", 'value' => 'Violence'])
                @include('interation.report_radio_button', ['content' => "Conteúdo de natureza sexual", 'value' => 'Nudity'])
                @include('interation.report_radio_button', ['content' => "Assédio", 'value' => 'Harassment'])
                @include('interation.report_radio_button', ['content' => "Lesões Autoprovocadas", 'value' => 'Self Harm'])

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Submeter</button>
            </div>
        </div>
    </form>
</div>