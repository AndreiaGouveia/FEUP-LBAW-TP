<?php

namespace App\Policies;

use App\Member;
use App\Question;

use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
      // Any user can create a new question
      return Auth::check();
    }

    public function show(Question $question)
    {
      // Only show a card question that is visible
      return $question->visible;
    }
}
