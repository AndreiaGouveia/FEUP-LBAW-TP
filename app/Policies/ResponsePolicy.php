<?php

namespace App\Policies;

use App\Person;
use App\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResponsePolicy
{
    use HandlesAuthorization;
    
    public function update(Person $user, Response $response) {
        return $user->isMember() && ($user->id == $response->publication->id_owner);

    }
}
