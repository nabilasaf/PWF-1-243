<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Update: user hanya bisa update produk miliknya sendiri.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }

    /**
     * Delete: admin bisa hapus produk siapapun,
     * user biasa hanya bisa hapus produk miliknya sendiri.
     */
    public function delete(User $user, Product $product): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $product->user_id;
    }
}
