<?php
function drawAccountSettings()
{

    drawPasswordSettings();

    drawDeletingAccountSettings();
}

function drawPasswordSettings()
{
?>

    <h3 class="font-weight-normal mb-3">Alterar Palavra-Passe</h3>
    <hr class="section-break" />

    <form>
        <div class="form-group">
            
            <div class="content mb-4">
                <label for="inputPreviousPassword">Palavra-Passe Antiga</label>
                <input type="password" id="inputPreviousPassword" class="form-control" placeholder="Palavra-Passe Antiga" required="" autofocus="">
            </div>

            <div class="content mb-4">
                <label for="inputNewPassword">Nova Palavra-Passe</label>
                <input type="password" id="inputNewPassword" class="form-control" placeholder="Nova Palavra-Passe" required="" autofocus="">
            </div>

            <div class="content mb-4">
                <label for="inputConfirmationOfNewPassword">Confirmação de Nova Palavra-Passe</label>
                <input type="password" id="inputConfirmationOfNewPassword" class="form-control" placeholder="Confirmação de Nova Palavra-Passe" required="" autofocus="">
            </div>

            <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Atualizar Palavra-Passe</button></div>

        </div>
    </form>
<?php

}

function drawDeletingAccountSettings()
{
?>
    <h3 class="font-weight-normal text-danger mb-3">Eliminar Conta</h3>
    <hr class="section-break" />

    <form>
        <div class="form-group">

            <label for="deleteAccount">Uma vez eliminada a conta, não há como voltar a trás. Por favor, tenha a certeza.</label><br>
            <div class="d-flex justify-content-end"><button type="submit" id="deleteAccount" class="btn btn-danger">Eliminar Conta</button></div>

        </div>
    </form>

<?php
}

?>