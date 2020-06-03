<?php

namespace App\Policies;

use App\Person;
use App\Publication;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublicationPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can delete the publication.
     *
     * @param  \App\Person  $user
     * @param  \App\Publication  $publication
     * @return mixed
     */
    public function delete(Person $user, Publication $publication)
    {
        return $user->isAdmin() || $user->isModerator() || ($user->id == $publication->id_owner);
    }

    public function report(Person $user, Publication $publication)
    {
        return $user->isMember();
    }

}
