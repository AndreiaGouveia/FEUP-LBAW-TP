@extends('layouts.app')

@section('title')
{{ $member->name }}
@endsection

@section('stylesheets')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection


@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md" >@include('partials.user_info', ["member" => $member])</div>
            <div class="col-md-8" >@include('partials.profile_activity', ["info" => $info])
            </div>
        </div>
    </div>

@endsection
