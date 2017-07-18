<?php

namespace App\Policies;

use App\User;
use App\Buyrecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyrecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the buyrecord.
     *
     * @param  \App\User  $user
     * @param  \App\Buyrecord  $buyrecord
     * @return mixed
     */
    public function view(User $user, Buyrecord $buyrecord)
    {
        //
    }

    /**
     * Determine whether the user can create buyrecords.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the buyrecord.
     *
     * @param  \App\User  $user
     * @param  \App\Buyrecord  $buyrecord
     * @return mixed
     */
    public function update(User $user, Buyrecord $buyrecord)
    {
        //
    }

    /**
     * Determine whether the user can delete the buyrecord.
     *
     * @param  \App\User  $user
     * @param  \App\Buyrecord  $buyrecord
     * @return mixed
     */
    public function delete(User $user, Buyrecord $buyrecord)
    {
        //
    }
}
