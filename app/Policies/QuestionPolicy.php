<?php

namespace App\Policies;

use App\Person;
use App\Question;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the question.
     *
     * @param  \App\Person  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function view(Person $user, Question $question)
    {
        return $question != null;
    }

    public function update(Person $user, Question $question) {
        return $user->isMember() && ($user->id == $question->publication->id_owner);

    }

}
