<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<?php

use App\Location;

$link = ($member->photo()->first() != null) ? $member->photo()->first()->url : "https://i.stack.imgur.com/l60Hf.png";

$curr_location = $member->id_location;

$temp = Location::get();

$locations = array();
array_push($locations, ' ');

foreach ($temp as &$value) {
    $new_location_array = array();

    if (isset($value->city))
        array_push($new_location_array, $value->city);

    if (isset($value->district)) {
        array_push($new_location_array, $value->district);
    }

    if (isset($value->country)) {
        array_push($new_location_array, $value->country);
    }

    $new_location = implode(",", $new_location_array);

    array_push($locations, $new_location);
}

?>


<h3 class="font-weight-normal mb-3">Alterar Perfil</h3>
<hr class="section-break" />

<form role="form" method="POST" action="{{ route('members.update', $member->id_person) }}">
    <div class="form-group">

        <div class="row flex-column-reverse flex-lg-row">

            <div class="col-md-8">

                @csrf
                <!--SUPER DUPER IMPORTANTE-->
                <div class="content mb-4">
                    <label for="inputName">Name</label><br>
                    <input type="text" id="inputName" name="name" class="form-control" placeholder="Name" value="{{ $member->name }}" required="" autofocus="">
                </div>

                <div class="content mb-4">
                    <label for="inputEmail">Email</label>
                    <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email" value="{{ $person->email }}" required="" autofocus="">
                </div>
                @if ($errors->has('email'))
                <span class="error">
                    {{ $errors->first('email') }}
                </span>
                @endif

                <div class="content mb-4">
                    <label for="inputLocalização">Localização<small class="font-italic"> - Optional</small></label>
                    <br>
                    <select id="inputLocalização" class="js-example-basic-single" name="location">
                        <script>
                            var myArray = <?php echo json_encode($locations); ?>;
                            for (i = 0; i < myArray.length; i++) {
                                document.write('<option value="' + i + '">' + myArray[i] + '</option>');
                            }
                            document.getElementById("inputLocalização").selectedIndex = <?php echo json_encode($curr_location); ?>;
                        </script>
                    </select>

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

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>