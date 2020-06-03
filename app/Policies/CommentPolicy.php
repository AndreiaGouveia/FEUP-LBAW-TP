<?php

namespace App\Policies;

use App\Person;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;
    
    public function update(Person $user, Comment $comment) {
        return $user->isMember() && ($user->id == $comment->publication->id_owner);

    }
}
