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
            return $user->hasPermission('list-product');
        });
        Gate::define('create-product', function ($user) {
            return $user->hasPermission('create-product');
        });
        Gate::define('delete-product', function ($user) {
            return $user->hasPermission('delete-product');
        });
        Gate::define('modify-product', function ($user) {
            return $user->hasPermission('modify-product');
        });
        //细节权限
        Gate::define('list-detail', function ($user) {
             return $user->hasPermission('list-detail');
        });
        Gate::define('create-detail', function ($user) {
            return $user->hasPermission('create-detail');
        });
        Gate::define('delete-detail', function ($user) {
            return $user->hasPermission('delete-detail');
        });
        Gate::define('modify-detail', function ($user) {
            return $user->hasPermission('modify-detail');
        });
        //订单权限
        Gate::define('list-buyrecord', function ($user) {
             return $user->hasPermission('list-buyrecord');
        });
        Gate::define('create-buyrecord', function ($user) {
            return $user->hasPermission('create-buyrecord');
        });
        Gate::define('delete-buyrecord', function ($user) {
            return $user->hasPermission('delete-buyrecord');
        });
        Gate::define('modify-buyrecord', function ($user) {
            return $user->hasPermission('modify-buyrecord');
        });
        //违约权限
        Gate::define('list-badrecord', function ($user) {
             return $user->hasPermission('list-badrecord');
        });
        Gate::define('create-badrecord', function ($user) {
            return $user->hasPermission('create-badrecord');
        });
        Gate::define('delete-badrecord', function ($user) {
            return $user->hasPermission('delete-badrecord');
        });
        Gate::define('modify-badrecord', function ($user) {
            return $user->hasPermission('modify-badrecord');
        });
        //元数据权限
        Gate::define('list-meta', function ($user) {
             return $user->hasPermission('list-meta');
        });
        Gate::define('create-meta', function ($user) {
            return $user->hasPermission('create-meta');
        });
        Gate::define('delete-meta', function ($user) {
            return $user->hasPermission('delete-meta');
        });
        Gate::define('modify-meta', function ($user) {
            return $user->hasPermission('modify-meta');
        });
        //日志权限
        Gate::define('list-log', function ($user) {
             return $user->hasPermission('list-log');
        });
        Gate::define('create-log', function ($user) {
            return $user->hasPermission('create-log');
        });
        Gate::define('delete-log', function ($user) {
            return $user->hasPermission('delete-log');
        });
        Gate::define('modify-log', function ($user) {
            return $user->hasPermission('modify-log');
        });
        //管理员权限
        Gate::define('list-manager', function ($user) {
             return $user->hasPermission('list-manager');
        });
        Gate::define('create-manager', function ($user) {
            return $user->hasPermission('create-manager');
        });
        Gate::define('delete-manager', function ($user) {
            return $user->hasPermission('delete-manager');
        });
        Gate::define('modify-manager', function ($user) {
            return $user->hasPermission('modify-manager');
        });
        //客户权限
        Gate::define('list-customer', function ($user) {
             return $user->hasPermission('list-customer');
        });
        Gate::define('create-customer', function ($user) {
            return $user->hasPermission('create-customer');
        });
        Gate::define('delete-customer', function ($user) {
            return $user->hasPermission('delete-customer');
        });
        Gate::define('modify-customer', function ($user) {
            return $user->hasPermission('modify-customer');
        });
        //角色权限
        Gate::define('list-role', function ($user) {
             return $user->hasPermission('list-role');
        });
        Gate::define('create-role', function ($user) {
             return $user->hasPermission('create-role');
        });
        Gate::define('delete-role', function ($user) {
             return $user->hasPermission('delete-role');
        });
        Gate::define('modify-role', function ($user) {
             return $user->hasPermission('modify-role');
        });

        //权限权限
        Gate::define('list-permission', function ($user) {
             return $user->hasPermission('list-permission');
        });
        Gate::define('create-permission', function ($user) {
             return $user->hasPermission('create-permission');
        });
        Gate::define('delete-permission', function ($user) {
             return $user->hasPermission('delete-permission');
        });
        Gate::define('modify-permission', function ($user) {
             return $user->hasPermission('modify-permission');
        });

        Gate::define('is-admin', function ($user) {
             return $user->hasPermission('is-admin');
        });  
    }
}
