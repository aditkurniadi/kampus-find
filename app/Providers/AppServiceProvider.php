<?php

namespace App\Providers;

use App\Models\User;
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
        // Sidebar 
        Gate::define('is-superadmin', function (User $user) {
            return $user->role == 'superadmin';
        });

        Gate::define('is-keamanan-superadmin', function (User $user) {
            return in_array($user->role, ['superadmin', 'keamanan']);
        });

        Gate::define('is-mahasiswa', function (User $user) {
            return $user->role == 'mahasiswa';
        });

        Gate::define('is-all', function (User $user) {
            return in_array($user->role, ['superadmin', 'keamanan', 'mahasiswa']);
        });

        Gate::define('can-view-announcement', function (User $user) {
            // Hanya izinkan keamanan dan mahasiswa
            return in_array($user->role, ['keamanan', 'mahasiswa']);
        });
    }
}
