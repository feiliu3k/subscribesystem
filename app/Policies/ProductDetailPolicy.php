<?php

namespace App\Policies;

use App\User;
use App\ProductDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the productDetail.
     *
     * @param  \App\User  $user
     * @param  \App\ProductDetail  $productDetail
     * @return mixed
     */
    public function view(User $user, ProductDetail $productDetail)
    {
        //
    }

    /**
     * Determine whether the user can create productDetails.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the productDetail.
     *
     * @param  \App\User  $user
     * @param  \App\ProductDetail  $productDetail
     * @return mixed
     */
    public function update(User $user, ProductDetail $productDetail)
    {
        //
    }

    /**
     * Determine whether the user can delete the productDetail.
     *
     * @param  \App\User  $user
     * @param  \App\ProductDetail  $productDetail
     * @return mixed
     */
    public function delete(User $user, ProductDetail $productDetail)
    {
        //
    }
}
