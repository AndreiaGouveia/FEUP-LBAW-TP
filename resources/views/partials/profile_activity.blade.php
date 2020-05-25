<div>
   <h3 class="font-weight-normal mb-3">Atividade recente </h3>
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