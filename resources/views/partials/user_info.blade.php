<?php
$link = ($member->photo()->first() != null) ? $member->photo()->first()->url : "https://i.stack.imgur.com/l60Hf.png";

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
    
    <div class="profile_info">

        <img src=<?=$link?> class="img d-inline-block align-center" alt="">
        <h6><br></h6>
        <div class="profile_data">
            <h2><?=$member->name?><span class="badge badge-light"><i class="fas fa-shield-alt"></i></span></h2>
            <p><span class="badge badge-light pl-0"> <i class="fas fa-address-book"></i> </span><?= $member->biography?></p>
            <p><span class="badge badge-light pl-0"> <i class="fas fa-map-marker-alt"></i> </span><?=$location?></p>
            <p><span class="badge badge-light pl-0"> <i class="fas fa-gem"></i> </span><?=$member->points?></p>
            <hr class="section-break" />
            <h5>Contribuições </h5>
            <p><span class="badge badge-light pl-0"> <i class="fas fa-question"></i> </span><?=$member->questions?> Perguntas</p>
            <p><span class="badge badge-light pl-0"> <i class="far fa-check-square"></i> </span><?=$member->comments?> Respotas</p>
            <p><span class="badge badge-light pl-0"> <i class="far fa-comment"></i></span><?=$member->reply?> Comentários</p>
        </div>
    </div>