<?php

use App\Livewire\Users;
use App\Livewire\Kategori;
use App\Livewire\Dashboard;
use App\Models\found_items;
use App\Livewire\FoundItems;
use App\Livewire\GaleriPage;
use Laravel\Fortify\Features;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\AnnouncementManager;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'dataCount' => found_items::whereDate('date_found', now()->today())->count(),
        'dataSelesai' => found_items::where('status', 'selesai')->count(),
        'barangTersedia' => found_items::where('status', 'available')->count(),
    ]);
})->name('home');

Route::get('/test', function () {
    return view('test');
})->name('test');


Route::get('/gallery', GaleriPage::class)->name('gallery');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    Route::get('users', Users::class)->name('users')->can('is-superadmin');
    Route::get('dashboard', Dashboard::class)->name('dashboard')->can('is-all');
    Route::get('kategori', Kategori::class)->name('kategori')->can('is-superadmin');
    Route::get('found-items', FoundItems::class)->name('foundItems')->can('is-keamanan-superadmin');

    Route::get('announcements', AnnouncementManager::class)
        ->name('announcements')
        ->can('is-keamanan-superadmin');
});
