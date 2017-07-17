<?php

namespace App\Policies;

use App\User;
use App\Badreord;
use Illuminate\Auth\Access\HandlesAuthorization;

class BadrecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the badreord.
     *
     * @param  \App\User  $user
     * @param  \App\Badreord  $badreord
     * @return mixed
     */
    public function view(User $user, Badreord $badrecord)
    {
        //
    }

    /**
     * Determine whether the user can create badreords.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the badreord.
     *
     * @param  \App\User  $user
     * @param  \App\Badreord  $badreord
     * @return mixed
     */
    public function update(User $user, Badreord $badrecord)
    {
        //
    }

    /**
     * Determine whether the user can delete the badreord.
     *
     * @param  \App\User  $user
     * @param  \App\Badreord  $badreord
     * @return mixed
     */
    public function delete(User $user, Badreord $badrecord)
    {
        //
    }
}
