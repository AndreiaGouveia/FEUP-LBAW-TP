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
     * Determine whether the user can view any questions.
     *
     * @param  \App\Person  $user
     * @return mixed
     */
    public function viewAny(Person $user)
    {
        //
    }

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

    /**
     * Determine whether the user can create questions.
     *
     * @param  \App\Person  $user
     * @return mixed
     */
    public function create(Person $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the question.
     *
     * @param  \App\Person  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function update(Person $user, Question $question)
    {
        //
    }

    /**
     * Determine whether the user can delete the question.
     *
     * @param  \App\Person  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function delete(Person $user, Question $question)
    {
        //
    }

    /**
     * Determine whether the user can restore the question.
     *
     * @param  \App\Person  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function restore(Person $user, Question $question)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the question.
     *
     * @param  \App\Person  $user
     * @param  \App\Question  $question
     * @return mixed
     */
    public function forceDelete(Person $user, Question $question)
    {
        //
    }
}
