<?php
$link = (isset($link_profile) && !$anonymous && !$banned) ? $link_profile : "images/default.png";
?>

<div class="header-card mb-3">
    <a @if(!$anonymous && !$banned) href="{{ route('members', $memberId) }}" @endif> <img src='{{asset("storage/$link")}}' class="img_inside mr-2" alt=""></a>
    <div class="header-text">
    <a @if(!$anonymous && !$banned) href="{{route('members', $memberId) }}" @endif><p class="name-and-action font-weight-bold d-inline">{{$banned ? "[Banned]" : (($anonymous) ? "[Anonymous]" : $name)}}</p></a>
        <p class="name-and-action d-inline">{{$action}}</p>
        <p class="name-and-action font-weight-bold d-inline">{{$actionInBold}}</p><br>
        <p><small>{{ date("Y-m-d",strtotime($date))}}</small></p>
    </div>
</div>
</a>