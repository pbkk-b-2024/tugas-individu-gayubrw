<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        // Definisikan gate untuk Admin
        Gate::define('admin-access', function (User $user) {
            return $user->role === 'admin';
        });

        // Definisikan gate untuk Guest (opsional jika hanya ingin explore)
        Gate::define('guest-access', function (User $user) {
            return $user->role === 'guest';
        });

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}

