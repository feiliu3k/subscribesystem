<?php

namespace App\Policies;

use App\User;
use App\Cusomer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the cusomer.
     *
     * @param  \App\User  $user
     * @param  \App\Cusomer  $cusomer
     * @return mixed
     */
    public function view(User $user, Cusomer $cusomer)
    {
        //
    }

    /**
     * Determine whether the user can create cusomers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the cusomer.
     *
     * @param  \App\User  $user
     * @param  \App\Cusomer  $cusomer
     * @return mixed
     */
    public function update(User $user, Cusomer $cusomer)
    {
        //
    }

    /**
     * Determine whether the user can delete the cusomer.
     *
     * @param  \App\User  $user
     * @param  \App\Cusomer  $cusomer
     * @return mixed
     */
    public function delete(User $user, Cusomer $cusomer)
    {
        //
    }
}
