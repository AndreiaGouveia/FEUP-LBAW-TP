<?php

namespace App\Policies;

use App\Person;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any comments.
     *
     * @param  \App\Person  $user
     * @return mixed
     */
    public function viewAny(Person $user)
    {
        //
    }

    /**
     * Determine whether the user can view the comment.
     *
     * @param  \App\Person  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function view(Person $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\Person  $user
     * @return mixed
     */
    public function create(Person $user)
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\Person  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(Person $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\Person  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(Person $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can restore the comment.
     *
     * @param  \App\Person  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function restore(Person $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the comment.
     *
     * @param  \App\Person  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function forceDelete(Person $user, Comment $comment)
    {
        //
    }
}
