<h3 class="font-weight-normal mb-3">Alterar Palavra-Passe</h3>
<hr class="section-break" />

<form role="form" method="POST" action="{{ route('members.update.password', ['id' => $member->id_person] )}}">
    <div class="form-group">

        @csrf
        <!--SUPER DUPER IMPORTANTE-->

        <div class="content mb-4">
            <label for="inputPreviousPassword">Palavra-Passe Antiga</label>
            <input type="password" name="old_password" id="inputPreviousPassword" class="form-control" placeholder="Palavra-Passe Antiga" required="" autofocus="">
        </div>

        <div class="content mb-4">
            <label for="inputNewPassword">Nova Palavra-Passe</label>
            <input type="password" name="password" id="inputNewPassword" class="form-control" placeholder="Nova Palavra-Passe" required="" autofocus="">
        </div>

        <div class="content mb-4">
            <label for="inputConfirmationOfNewPassword">Confirmação de Nova Palavra-Passe</label>
            <input type="password" name="password_confirmation" id="inputConfirmationOfNewPassword" class="form-control" placeholder="Confirmação de Nova Palavra-Passe" required="" autofocus="">
        </div>
        @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
        @endif

        <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Atualizar Palavra-Passe</button></div>

    </div>
</form>