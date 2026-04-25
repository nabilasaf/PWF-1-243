<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('manage-products', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('export-product', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-category', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-product', function ($user) {
            return $user->role === 'admin';
        });

        Gate::policy(Product::class, ProductPolicy::class);
    }
}
