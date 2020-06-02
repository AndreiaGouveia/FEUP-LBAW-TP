@extends('layouts.app')

@section('title')
Definições
@endsection

@section('stylesheets')

<link rel="stylesheet" type="text/css" href="{{ asset('css/settings.css') }}">

@parent
@endsection

@section('javascript')
<script type="text/javascript" src={{ asset('js/image_settings.js') }} defer></script>
@endsection

@section('content')
<?php

$accountIsActive = "active";
$profileIsActive = "";

if ($errors->has('password') || $errors->has('old_password')) {
    $accountIsActive = "";
    $profileIsActive = "active";
}
?>

<div class="container mt-5">

    <div class="row">

        <div class="col-md pr-5 mr-4 d-none d-xl-block">

            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action py-2 <?= $accountIsActive ?>" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Perfil</a>
                <a class="list-group-item list-group-item-action py-2 <?= $profileIsActive ?>" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Conta</a>
            </div>
        </div>

        <!-- mobile version -->
        <div class="col-md d-xl-none mb-4 mobile">

            <h3 class="font-weight-normal mb-4">Definições</h3>
            <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action py-2 <?= $accountIsActive ?>" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Perfil</a>
                <a class="list-group-item list-group-item-action py-2 <?= $profileIsActive ?>" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Conta</a>
            </div>
        </div>

        <div class="col-md-8">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade <?= " show " . $accountIsActive ?>" id="list-home" role="tabpanel" aria-labelledby="list-home-list">@include('partials.profile_settings')</div>
                <div class="tab-pane fade <?= " show " . $profileIsActive ?>" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">@include('partials.account_settings')</div>
            </div>
        </div>
    </div>
</div>

@endsection