<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        // Hanya user dengan peran 'admin' yang dapat menambah produk
        return $user->role === 'admin';
    }

    public function update(User $user, Product $product)
    {
        // Hanya user dengan peran 'admin' yang dapat mengedit produk
        return $user->role === 'admin';
    }

    public function delete(User $user, Product $product)
    {
        // Hanya user dengan peran 'admin' yang dapat menghapus produk
        return $user->role === 'admin';
    }

    public function viewAny(User $user)
    {
        // Semua user dapat melihat daftar produk
        return true;
    }
}
