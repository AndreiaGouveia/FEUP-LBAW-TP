@extends('layouts.app')

@section('stylesheets')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}">
@endsection


@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md" >@include('partials.user_info', ["member" => $member])</div>
            <div class="col-md" >@foreach ($info as $publication)
                                     @if (get_class($publication) == "App\Question")
                                            @include('activities.question_activity', ["question" => $publication])
                                     @elseif (get_class($publication) == "App\Answer")
                                            @include('activities.answer_activity', ["answer" => $publication])
                                     @elseif (get_class($publication) == "App\Comment")
                                            @include('activities.comment_activity', ["comment" => $publication])
                                     @endif
                                 @endforeach
                                 </div>
        </div>
    </div>

@endsection
