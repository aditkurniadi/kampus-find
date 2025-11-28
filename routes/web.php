<?php

use App\Livewire\Users;
use App\Models\Feedback;
use App\Livewire\Kategori;
use App\Livewire\Dashboard;
use App\Livewire\MyReports;
use App\Models\found_items;
use App\Livewire\FoundItems;
use App\Livewire\GaleriPage;
use Laravel\Fortify\Features;
use App\Livewire\FeedbackManager;
use App\Livewire\ModeratorReports;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\AnnouncementManager;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Livewire\Mahasiswa\ReportLostItem;

Route::get('/', function () {
    return view('welcome', [
        // Data Statistik yang lama
        'dataCount' => found_items::whereDate('date_found', now()->today())->count(),
        'dataSelesai' => found_items::where('status', 'selesai')->count(),
        'barangTersedia' => found_items::where('status', 'available')->count(),

        'feedbacks' => Feedback::with('user')
            ->where('is_visible', true)
            ->latest()
            ->take(10) // Ambil 10 ulasan terbaru
            ->get(),
        'averageRating' => Feedback::where('is_visible', true)->avg('rating')
    ]);
})->name('home');

Route::get('/feedback', App\Livewire\UserFeedback::class)->name('feedback')->middleware('auth');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


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

    Route::get('report', MyReports::class)->name('reportMhs')->can('is-mahasiswa');
    Route::get('my-lost-items', App\Livewire\Mahasiswa\MyLostItems::class)->name('myLostItems')->can('is-mahasiswa');
    Route::get('reportManager', ModeratorReports::class)->name('reportManager')->can('is-keamanan-superadmin');

    Route::get('admin/feedback-manager', FeedbackManager::class)->name('admin.feedback')->can('is-keamanan-superadmin');

    // Route Admin untuk Manage Lost Items
    Route::get('/admin/lost-items', App\Livewire\Admin\LostItemManager::class)
        ->middleware('can:is-keamanan-superadmin') // atau is-keamanan
        ->name('admin.lostItems');

    // Route Chat Room (Bisa diakses Admin & Mahasiswa pemilik item)
    Route::get('/chat/{id}', App\Livewire\Chat\Room::class)->name('chat.room');
});

Route::middleware(['auth', 'can:is-mahasiswa'])->group(function () {
    Route::get('/report-lost', ReportLostItem::class)->name('report.lost');
});
