<?php
$link = (isset($link_profile) && !$anonymous) ? $link_profile : "https://i.stack.imgur.com/l60Hf.png";
?>

<div class="header-card mb-3">
    <a @if(!$anonymous) href="{{ route('members', $memberId) }}" @endif><img src={{$link}} class="img_inside mr-2" alt=""></a>
    <div class="header-text">
    <a @if(!$anonymous) href="{{route('members', $memberId) }}" @endif><p class="name-and-action font-weight-bold d-inline">{{($anonymous) ? "[Anonymous]" : $name}}</p></a>
        <p class="name-and-action d-inline">{{$action}}</p>
        <p class="name-and-action font-weight-bold d-inline">{{$actionInBold}}</p><br>
        <p><small>{{$date}}</small></p>
    </div>
</div>
</a>