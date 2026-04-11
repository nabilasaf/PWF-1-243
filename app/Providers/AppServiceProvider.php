<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate: hanya admin yang bisa mengelola product
        Gate::define('manage-product', function ($user) {
            return $user->role === 'admin';
        });

        // Gate: hanya admin yang bisa export product (Kelas B)
        Gate::define('export-product', function ($user) {
            return $user->role === 'admin';
        });

        // Daftarkan ProductPolicy
        Gate::policy(Product::class, ProductPolicy::class);
    }
}
