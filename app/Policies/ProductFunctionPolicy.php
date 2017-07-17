<?php

namespace App\Policies;

use App\User;
use App\ProductFunction;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductFunctionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the productFunction.
     *
     * @param  \App\User  $user
     * @param  \App\ProductFunction  $productFunction
     * @return mixed
     */
    public function view(User $user, ProductFunction $productFunction)
    {
        //
    }

    /**
     * Determine whether the user can create productFunctions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the productFunction.
     *
     * @param  \App\User  $user
     * @param  \App\ProductFunction  $productFunction
     * @return mixed
     */
    public function update(User $user, ProductFunction $productFunction)
    {
        //
    }

    /**
     * Determine whether the user can delete the productFunction.
     *
     * @param  \App\User  $user
     * @param  \App\ProductFunction  $productFunction
     * @return mixed
     */
    public function delete(User $user, ProductFunction $productFunction)
    {
        //
    }
}
