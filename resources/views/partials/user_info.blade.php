<?php
$link = ($member->photo != null) ? $member->photo->url : "images/default.png";

$location_array = array();
if ($member->location != null) {

    if (isset($member->location->city))
        array_push($location_array, $member->location->city);

    if (isset($member->location->district)) {
        array_push($location_array, $member->location->district);
    }

    if (isset($member->location->country)) {
        array_push($location_array, $member->location->country);
    }
}

$location = implode(",", $location_array);

?>

<div class="profile_info">

    <img src='{{asset("storage/$link")}}' class="img d-inline-block align-center" alt="">
    <h6><br></h6>
    <div class="profile_data">

        <div class="row container">
            <h2>{{$member->name}}</h2>
            <h2>@if($member->moderator)<span class="badge badge-light"><i class="fas fa-shield-alt"></i></span>@endif</h2>

            @isAdmin()
            @if($member->moderator)
            <form method="post" action="{{ route('member.demote', $member->id_person)}}">
                @csrf
                <button type="submit" class="btn px-1 py-0" autocomplete="off">
                    <h2 class="m-0"><i class="fas fa-arrow-alt-circle-down"></i></h2>
                </button>
            </form>
            @else
            <form method="post" action="{{ route('member.promote', $member->id_person)}}" class="ml-2">
                @csrf
                <button type="submit" class="btn px-1 py-0" autocomplete="off">
                    <h2 class="m-0"><i class="fas fa-arrow-alt-circle-up"></i></h2>
                </button>
            </form>
            @endif
            @endisAdmin
        </div>

        @if (isset($member->biography) && (trim($member->biography) != '') && ($member->biography != null ))
        <p><span class="badge badge-light pl-0"> <i class="fas fa-address-book"></i> </span> {{ $member->biography }}</p>
        @endif

        @if (isset($location) && (trim($location) !== '') && ($location != null))
        <p><span class="badge badge-light pl-0"> <i class="fas fa-map-marker-alt"></i> </span>{{ $location }}</p>
        @endif

        @if (isset($member->points) && trim($member->points) != '' && $member->points != null )
        <p><span class="badge badge-light pl-0"> <i class="fas fa-gem"></i> </span> {{ $member->points }}</p>
        @endif

        <hr class="section-break" />
        <h5>Contribuições </h5>
        <p><span class="badge badge-light pl-0"> <i class="fas fa-question"></i> </span>{{ $member->questions->count() }} Perguntas</p>
        <p><span class="badge badge-light pl-0"> <i class="far fa-check-square"></i> </span>{{ $member->answers->count() }} Respostas</p>
        <p><span class="badge badge-light pl-0"> <i class="far fa-comment"></i></span>{{ $member->comments->count() }} Comentários</p>
    </div>
</div>