<h3 class="font-weight-normal mb-3">Alterar Palavra-Passe</h3>
<hr class="section-break" />

<form method="POST" action="{{ route('members.update.password', ['id' => $member->id_person] )}}">
    <div class="form-group">

        @csrf
        <!--SUPER DUPER IMPORTANTE-->

        <div class="content mb-4">
            <label for="inputPreviousPassword">Palavra-Passe Antiga</label>
            <input type="password" name="old_password" id="inputPreviousPassword" class="form-control" placeholder="Palavra-Passe Antiga" required="">
        </div>
        @if ($errors->has('old_password'))
        <span class="error">
            {{ $errors->first('old_password') }}
        </span>
        @endif

        <div class="content mb-4">
            <label for="inputNewPassword">Nova Palavra-Passe</label>
            <input type="password" name="password" id="inputNewPassword" class="form-control" placeholder="Nova Palavra-Passe" required="">
        </div>

        <div class="content mb-4">
            <label for="inputConfirmationOfNewPassword">Confirmação de Nova Palavra-Passe</label>
            <input type="password" name="password_confirmation" id="inputConfirmationOfNewPassword" class="form-control" placeholder="Confirmação de Nova Palavra-Passe" required="">
        </div>
        @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
        @endif

        <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Atualizar Palavra-Passe</button></div>

    </div>
</form>

<h3 class="font-weight-normal text-danger mb-3">Desativar Conta</h3>
<hr class="section-break" />

<div class="form-group">

    <label for="deleteAccount">Uma vez desativada a conta, o seu conteúdo vai deixar de estar disponivel. Por favor, tenha a certeza.</label><br>
    <div class="d-flex justify-content-end">
        <button id="deleteAccount" class="btn btn-danger" data-toggle="modal" data-target="#deletingAccountPopUp">Desativar Conta</button>
    </div>


    <form method="POST" action="{{ route('members.deactivate', ['id' => $member->id_person] )}}">
        @csrf
        <!--SUPER DUPER IMPORTANTE-->

        <div class="modal fade" id="deletingAccountPopUp" tabindex="-1" role="dialog" aria-labelledby="#deletingAccountPopUpLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletingAccountPopUpLabel">Eliminar Conta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <p class="px-3 my-2">Tem a certeza que quer desativar a sua conta?</p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Sim</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>