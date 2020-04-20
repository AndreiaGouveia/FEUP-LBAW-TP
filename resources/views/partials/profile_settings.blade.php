<?php
$link = ($member->photo() != null) ? $member->photo()->first()->url : "https://i.stack.imgur.com/l60Hf.png";

$location_array = array();
if ($member->location()->first() != null) {

    if (isset($member->location()->first()->city))
        array_push($location_array, $member->location()->first()->city);

    if (isset($member->location()->first()->district)) {
        array_push($location_array, $member->location()->first()->district);
    }

    if (isset($member->location()->first()->country)) {
        array_push($location_array, $member->location()->first()->country);
    }
}

$location = implode(",", $location_array);



?>
<h3 class="font-weight-normal mb-3">Alterar Perfil</h3>
<hr class="section-break" />

<form role="form" method="POST" action="{{ route('membersUpdate', $member->id_person) }}">
    <div class="form-group">

        <div class="row flex-column-reverse flex-lg-row">

            <div class="col-md-8">

                @csrf <!--SUPER DUPER IMPORTANTE-->
                <div class="content mb-4">
                    <label for="inputName">Name</label><br>
                    <input type="text" id="inputName" name="name" class="form-control" placeholder="Name" value="{{ $member->name }}" required="" autofocus="">
                </div>

                <div class="content mb-4">
                    <label for="inputEmail">Email</label>
                    <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email" value="{{ $person->email }}" required="" autofocus="">
                </div>

                <div class="content mb-4">
                    <label for="inputLocalização">Localização<small class="font-italic"> - Optional</small></label>
                    <input type="text" id="inputLocalização" name="location" class="form-control" placeholder="Localização" value="<?= $location ?>" autofocus="">
                </div>

            </div>

            <div class="col-md">
                <div class="content mb-4">
                    <label for="profilePic">Foto de Perfil</label><br>
                    <img src=<?= $link ?> id="profilePic" class="img-settings" alt="">
                </div>
            </div>

        </div>

        <div class="content mb-4">
            <label for="textAreaBio">Bio<small class="font-italic"> - Optional</small></label>
            <textarea type="text" id="textAreaBio" name="biography" class="form-control" placeholder="Bio" value="{{ $member->biography }}" autofocus="" rows="3"></textarea>
        </div>

        <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Atualizar Perfil</button></div>

    </div>
</form>