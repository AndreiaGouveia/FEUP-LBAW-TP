<?php

namespace App\Policies;

use App\Person;
use App\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any members.
     *
     * @param  \App\Person  $user
     * @return mixed
     */
    public function viewAny(Person $user)
    {
        //
    }

    /**
     * Determine whether the user can view the member.
     *
     * @param  \App\Person  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function view(Person $user, Member $member)
    {
        //
    }

    /**
     * Determine whether the user can create members.
     *
     * @param  \App\Person  $user
     * @return mixed
     */
    public function create(Person $user)
    {
        //
    }

    /**
     * Determine whether the user can update the member.
     *
     * @param  \App\Person  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function update(Person $user, Member $member)
    {
        return $user->id == $member->id_person && auth()->user()->id == $member->id_person;
    }

    public function updatePassowrd(Person $user, Member $member, $value)
    {
        
        return $user->id == $member->id_person && Hash::check($value, auth()->user()->password);
    }

    /**
     * Determine whether the user can delete the member.
     *
     * @param  \App\Person  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function delete(Person $user, Member $member)
    {
        //
    }

    /**
     * Determine whether the user can restore the member.
     *
     * @param  \App\Person  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function restore(Person $user, Member $member)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the member.
     *
     * @param  \App\Person  $user
     * @param  \App\Member  $member
     * @return mixed
     */
    public function forceDelete(Person $user, Member $member)
    {
        //
    }
}
