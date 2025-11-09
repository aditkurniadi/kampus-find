<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\categories;
use App\Models\found_items;
use Livewire\Attributes\On;
use App\Models\Announcement;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalFound;
    public $announcements;
    public $users;

    public function mount(): void
    {
        $this->totalUsers = User::count();
        $this->totalFound = found_items::count();
        // --- 3. LOGIKA YANG DIPERBARUI ---
        // Ambil 3 pengumuman terbaru yang masih aktif
        $this->announcements = Announcement::with('user')
            ->where('is_active', true)
            ->latest()
            ->take(3) // <-- [DIUBAH] Ambil 3 data
            ->get();
    }

    #[On('user-updated')]
    public function refreshTotalUsers(): void
    {
        $this->totalUsers = User::count();
    }

    #[On('item-updated')]
    public function refreshTotalFound(): void
    {
        $this->totalFound = found_items::count();
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'title' => 'Dashboard',
            'totalUsers' => $this->totalUsers,
            'totalKategori' => categories::count(),
            'totalFound' => $this->totalFound,
            'userName' => auth()->user()->name,
        ]);
    }
}
