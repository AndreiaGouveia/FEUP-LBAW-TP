<?php
function drawProfileSettings()
{
?>

    <h3 class="font-weight-normal mb-3">Perfil</h3>
    <hr class="section-break" />

    <form>
        <div class="form-group">

            <div class="row">

                <div class="col-md-8">

                    <div class="content mb-4">
                        <label for="inputName">Name</label><br>
                        <input type="text" id="inputName" class="form-control" placeholder="Name" required="" autofocus="">
                    </div>

                    <div class="content mb-4">
                        <label for="inputEmail">Email</label>
                        <input type="text" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="">
                    </div>

                    <div class="content mb-4">
                        <label for="inputLocalização">Localização<small class="font-italic"> - Optional</small></label>
                        <input type="text" id="inputLocalização" class="form-control" placeholder="Localização" autofocus="">
                    </div>

                </div>

                <div class="col-md">
                    <div class="content mb-4">
                        <label for="profilePic">Foto de Perfil</label><br>
                        <img src="..\\images\profile_picture1.png" id="profilePic" class="img-settings" alt="">
                    </div>
                </div>

            </div>

            <div class="content mb-4">
                <label for="textAreaBio">Bio<small class="font-italic"> - Optional</small></label>
                <textarea type="text" id="textAreaBio" class="form-control" placeholder="Bio" autofocus="" rows="3"></textarea>
            </div>

            <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Atualizar Perfil</button></div>

        </div>
    </form>

<?php

}
?>