<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('show-product', function ($user, $product) {
        //     return $user->owns($product);
        // });

        // Gate::define('show-detail', function ($user, $detail) {
        //     return $user->owns($detail->product);
        // });

        // Gate::define('show-buyrecord', function ($user, $buyrecord) {
        //     return $user->owns($buyrecord->product);
        // });

        // Gate::define('show-badrecord', function ($user, $badrecord) {
        //     return $user->owns($badrecord->product);
        // });
    }
}
