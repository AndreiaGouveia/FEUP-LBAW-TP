@extends('layouts.app')

@section('stylesheets')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection


@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md" >@include('partials.user_info', ["member" => $member])</div>
        </div>
    </div>

@endsection
