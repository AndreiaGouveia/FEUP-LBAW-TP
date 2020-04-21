<?php

namespace App\Policies;

use App\Person;
use App\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any responses.
     *
     * @param  \App\Person  $user
     * @return mixed
     */
    public function viewAny(Person $user)
    {
        //
    }

    /**
     * Determine whether the user can view the response.
     *
     * @param  \App\Person  $user
     * @param  \App\Response  $response
     * @return mixed
     */
    public function view(Person $user, Response $response)
    {
        //
    }

    /**
     * Determine whether the user can create responses.
     *
     * @param  \App\Person  $user
     * @return mixed
     */
    public function create(Person $user)
    {
        // Any user can create a new card
        return Auth::check();
    }

    /**
     * Determine whether the user can update the response.
     *
     * @param  \App\Person  $user
     * @param  \App\Response  $response
     * @return mixed
     */
    public function update(Person $user, Response $response)
    {
        //
    }

    /**
     * Determine whether the user can delete the response.
     *
     * @param  \App\Person  $user
     * @param  \App\Response  $response
     * @return mixed
     */
    public function delete(Person $user, Response $response)
    {
        //
    }

    /**
     * Determine whether the user can restore the response.
     *
     * @param  \App\Person  $user
     * @param  \App\Response  $response
     * @return mixed
     */
    public function restore(Person $user, Response $response)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the response.
     *
     * @param  \App\Person  $user
     * @param  \App\Response  $response
     * @return mixed
     */
    public function forceDelete(Person $user, Response $response)
    {
        //
    }
}
