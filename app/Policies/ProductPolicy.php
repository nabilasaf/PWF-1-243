<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Update: hanya admin yang bisa edit, dan hanya produk miliknya sendiri.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->role === 'admin' && $user->id === $product->user_id;
    }

    /**
     * Delete: hanya admin yang bisa hapus, dan hanya produk miliknya sendiri.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->role === 'admin' && $user->id === $product->user_id;
    }
}
