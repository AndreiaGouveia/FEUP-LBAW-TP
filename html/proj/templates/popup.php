<?php

function reportPopUp($idOfPopUp)
{
?>
    <div class="modal fade" id="<?= $idOfPopUp ?>" tabindex="-1" role="dialog" aria-labelledby="#<?= $idOfPopUp ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="<?= $idOfPopUp ?>Label">Reportar Conteúdo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="px-3 my-2">
                    <?php
                    popUpCheckBox("Sexual Content");
                    popUpCheckBox("Violent or repulsive content");
                    popUpCheckBox("Hateful or abusive content");
                    popUpCheckBox("Spam or misleading");

                    ?>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Submeter</button>
                </div>
            </div>
        </div>
    </div>

<?php
}

function deletingAccountPopUp($idOfPopUp)
{
?>
    <div class="modal fade" id="<?=$idOfPopUp?>" tabindex="-1" role="dialog" aria-labelledby="#<?=$idOfPopUp?>Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="<?=$idOfPopUp?>Label">Eliminar Conta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <p class="px-3 my-2">Tem a certeza que quer eliminar a sua conta?</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Sim</button>
                </div>
            </div>
        </div>
    </div>

<?php
}

function popUpCheckBox($content)
{
?>

    <div class="input-group py-1">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="Checkbox for following text input">
            </div>
        </div>
        <label type="text" class="form-control" aria-label="Text input with checkbox"><?= $content ?></label>
    </div>

<?php

}
?>