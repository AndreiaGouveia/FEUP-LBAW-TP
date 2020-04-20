@extends('layouts.app')

@section('stylesheets')

<link rel="stylesheet" type="text/css" href="{{ asset('css/settings.css') }}">

@parent
@endsection

@section('content')
<div class="container mt-5">

    <div class="row">

        <div class="col-md pr-5 mr-4 d-none d-xl-block">

            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active py-2" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Perfil</a>
                <a class="list-group-item list-group-item-action py-2" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Conta</a>
            </div>
        </div>

        <!-- mobile version -->
        <div class="col-md d-xl-none mb-4 mobile">

            <h3 class="font-weight-normal mb-4">Definições</h3>
            <div class="list-group list-group-horizontal" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active py-2" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Perfil</a>
                <a class="list-group-item list-group-item-action py-2" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Conta</a>
            </div>
        </div>

        <div class="col-md-8">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">@include('partials.profile_settings')</div>
                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list"><?php /*drawAccountSettings();*/ ?></div>
            </div>
        </div>
    </div>
</div>

@endsection