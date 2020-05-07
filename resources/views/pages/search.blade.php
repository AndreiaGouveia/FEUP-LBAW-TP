@extends('layouts.app')

@section('stylesheets')
@parent

<link rel="stylesheet" type="text/css" href="{{ asset('css/main_page.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection


@section('content')

<div class="container mt-5">
        <div class="row">
            <div class="col-md" ><p><?php echo $search ?></p></div>
            
        </div>
    </div>

@endsection
