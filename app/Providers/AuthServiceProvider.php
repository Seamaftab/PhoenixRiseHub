<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //UserPolicy
        Gate::define('view_users', [UserPolicy::class, 'viewAny']);
        Gate::define('update_users', [UserPolicy::class, 'update']);
        Gate::define('delete_users', [UserPolicy::class, 'delete']);
        //ProductPolicy
        Gate::define('view_product_gate', [ProductPolicy::class, 'viewAny']);
        Gate::define('delete_product_gate', [ProductPolicy::class, 'delete']);
        Gate::define('update_product_gate', [ProductPolicy::class, 'update']);
        //OrderPolicy
        Gate::define('view_orders', [OrderPolicy::class, 'view']);
        Gate::define('update_orders', [OrderPolicy::class, 'update']);
        Gate::define('delete_orders', [OrderPolicy::class, 'delete']);
    }
}
