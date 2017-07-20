<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

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
          
        //产品权限
        Gate::define('list-product', function ($user) {
            return $user->hasPermission('is-admin') || $user->hasPermission('list-product');
        });
        Gate::define('create-product', function ($user) {
            return $user->hasPermission('is-admin') || $user->hasPermission('create-product');
        });
        Gate::define('delete-product', function ($user, $product) {
            return $user->hasPermission('is-admin') || ($user->hasPermission('delete-product') && $user->owns($product));
        });
        Gate::define('modify-product', function ($user, $product) {
            return $user->hasPermission('is-admin') || ($user->hasPermission('modify-product') && $user->owns($product));
        });
        //细节权限
        Gate::define('list-detail', function ($user) {
             return $user->hasPermission('is-admin') || $user->hasPermission('list-detail');
        });
        Gate::define('create-detail', function ($user) {
            return $user->hasPermission('is-admin') || $user->hasPermission('create-detail');
        });
        Gate::define('delete-detail', function ($user, $detail) {
            return $user->hasPermission('is-admin') || ($user->hasPermission('delete-detail') && $user->owns($detail->product));
        });
        Gate::define('modify-detail', function ($user) {
            return $user->hasPermission('is-admin') || ($user->hasPermission('modify-detail', $detail) && $user->owns($detail->product));
        });
        //订单权限
        Gate::define('list-buyrecord', function ($user) {
             return $user->hasPermission('is-admin') || $user->hasPermission('list-buyrecord');
        });
        Gate::define('create-buyrecord', function ($user) {
            return $user->hasPermission('is-admin') || $user->hasPermission('create-buyrecord');
        });
        Gate::define('delete-buyrecord', function ($user, $buyrecord) {
            return $user->hasPermission('is-admin') || ($user->hasPermission('delete-buyrecord') && $user->owns($buyrecord));
        });
        Gate::define('modify-buyrecord', function ($user, $buyrecord) {
            return $user->hasPermission('is-admin') || ($user->hasPermission('modify-buyrecord') && $user->owns($buyrecord));
        });
        //违约权限
        Gate::define('list-badrecord', function ($user) {
             return $user->hasPermission('is-admin') || $user->hasPermission('list-badrecord');
        });
        Gate::define('create-badrecord', function ($user) {
            return $user->hasPermission('is-admin') || $user->hasPermission('create-badrecord');
        });
        Gate::define('delete-badrecord', function ($user) {
            return $user->hasPermission('is-admin') || ($user->hasPermission('delete-badrecord', $badrecord) && $user->owns($badrecord));
        });
        Gate::define('modify-badrecord', function ($user) {
            return $user->hasPermission('is-admin') || ($user->hasPermission('modify-badrecord', $badrecord) && $user->owns($badrecord));
        });
        //元数据权限
        Gate::define('list-meta', function ($user) {
             return $user->hasPermission('list-meta') && $user->hasPermission('is-admin');
        });
        Gate::define('create-meta', function ($user) {
            return $user->hasPermission('create-meta') && $user->hasPermission('is-admin');
        });
        Gate::define('delete-meta', function ($user) {
            return $user->hasPermission('delete-meta') && $user->hasPermission('is-admin');
        });
        Gate::define('modify-meta', function ($user) {
            return $user->hasPermission('modify-meta') && $user->hasPermission('is-admin');
        });
        //日志权限
        Gate::define('list-log', function ($user) {
             return $user->hasPermission('list-log') && $user->hasPermission('is-admin');
        });
        Gate::define('create-log', function ($user) {
            return $user->hasPermission('create-log') && $user->hasPermission('is-admin');
        });
        Gate::define('delete-log', function ($user) {
            return $user->hasPermission('delete-log') && $user->hasPermission('is-admin');
        });
        Gate::define('modify-log', function ($user) {
            return $user->hasPermission('modify-log') && $user->hasPermission('is-admin');
        });
        //管理员权限
        Gate::define('list-manager', function ($user) {
             return $user->hasPermission('list-manager') && $user->hasPermission('is-admin');
        });
        Gate::define('create-manager', function ($user) {
            return $user->hasPermission('create-manager') && $user->hasPermission('is-admin');
        });
        Gate::define('delete-manager', function ($user) {
            return $user->hasPermission('delete-manager') && $user->hasPermission('is-admin');
        });
        Gate::define('modify-manager', function ($user) {
            return $user->hasPermission('modify-manager') && $user->hasPermission('is-admin');
        });
        //客户权限
        Gate::define('list-customer', function ($user) {
             return $user->hasPermission('list-customer') && $user->hasPermission('is-admin');
        });
        Gate::define('create-customer', function ($user) {
            return $user->hasPermission('create-customer') && $user->hasPermission('is-admin');
        });
        Gate::define('delete-customer', function ($user) {
            return $user->hasPermission('delete-customer') && $user->hasPermission('is-admin');
        });
        Gate::define('modify-customer', function ($user) {
            return $user->hasPermission('modify-customer') && $user->hasPermission('is-admin');
        });
        //角色权限
        Gate::define('list-role', function ($user) {
             return $user->hasPermission('list-role') && $user->hasPermission('is-admin');
        });
        Gate::define('create-role', function ($user) {
             return $user->hasPermission('create-role') && $user->hasPermission('is-admin');
        });
        Gate::define('delete-role', function ($user) {
             return $user->hasPermission('delete-role') && $user->hasPermission('is-admin');
        });
        Gate::define('modify-role', function ($user) {
             return $user->hasPermission('modify-role') && $user->hasPermission('is-admin');
        });

        //权限权限
        Gate::define('list-permission', function ($user) {
             return $user->hasPermission('list-permission') && $user->hasPermission('is-admin');
        });
        Gate::define('create-permission', function ($user) {
             return $user->hasPermission('create-permission') && $user->hasPermission('is-admin');
        });
        Gate::define('delete-permission', function ($user) {
             return $user->hasPermission('delete-permission') && $user->hasPermission('is-admin');
        });
        Gate::define('modify-permission', function ($user) {
             return $user->hasPermission('modify-permission') && $user->hasPermission('is-admin');
        });

        Gate::define('is-admin', function ($user) {
             return $user->hasPermission('is-admin');
        });  
    }
}
