<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Feedback;
use App\Models\categories;
use App\Models\found_items;
use Livewire\Attributes\On;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalFound;
    public $announcements;
    public $returnedToday;
    public $users;
    public $averageRating;

    public $myTotalReports;
    public $myActiveReports;
    public $mySolvedReports;
    public $myRecentReports;
    public $myLostReports;

    public $chartDates = [];
    public $chartFoundData = [];
    public $chartSolvedData = [];

    public $chartPieLabels = [];
    public $chartPieSeries = [];

    public $recentActivities;

    public $confirmingMaintenance = false; // Untuk kontrol modal
    public $passwordConfirmation = '';
    public $isMaintenanceOn = false;

    public function mount(): void
    {
        $this->totalUsers = User::count();
        $this->totalFound = found_items::count();

        $this->returnedToday = found_items::where('status', 'selesai')
            ->whereDate('updated_at', now()->today())
            ->count();

        $avg = Feedback::where('is_visible', true)->avg('rating');
        $this->averageRating = $avg ? number_format($avg, 1) : 0;

        $this->announcements = Announcement::with('user')
            ->where('is_active', true)
            ->latest()
            ->take(3) // <-- [DIUBAH] Ambil 3 data
            ->get();

        $setting = Setting::where('key', 'maintenance_mode')->first();
        $this->isMaintenanceOn = $setting && $setting->value === 'true';

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            // 1. Label Tanggal (cth: "28 Nov")
            $this->chartDates[] = $date->format('d M');

            // 2. Data Barang Ditemukan (Berdasarkan date_found)
            $this->chartFoundData[] = found_items::whereDate('date_found', $date)->count();

            // 3. Data Barang Kembali (Berdasarkan updated_at & status selesai)
            $this->chartSolvedData[] = found_items::where('status', 'selesai')
                ->whereDate('updated_at', $date)
                ->count();
        }

        $categoryStats = found_items::join('categories', 'found_items.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('count(*) as total'))
            ->groupBy('categories.name')
            ->orderByDesc('total') // Urutkan dari yang terbanyak
            ->limit(5) // Ambil top 5 kategori saja agar chart tidak penuh
            ->pluck('total', 'name'); // Hasilnya Collection: ['Elektronik' => 10, 'Dompet' => 5]

        $this->chartPieLabels = $categoryStats->keys()->toArray();
        $this->chartPieSeries = $categoryStats->values()->toArray();

        $this->recentActivities = found_items::with(['user', 'category'])
            ->latest() // Urutkan dari yang paling baru dibuat
            ->take(5)  // Ambil 5 saja
            ->get();

        // Role Mahasiswa
        if (auth()->user()->role === 'mahasiswa') { // Sesuaikan dengan logika role Anda
            // 1. Total Laporan Saya
            $this->myTotalReports = found_items::where('user_id', auth()->id())->count();

            // 2. Sedang Diproses (Available/Hilang)
            $this->myActiveReports = found_items::where('user_id', auth()->id())
                ->where('status', '!=', 'selesai')
                ->count();

            // 3. Sudah Kembali (Selesai)
            $this->mySolvedReports = found_items::where('user_id', auth()->id())
                ->where('status', 'selesai')
                ->count();

            // Tabel 4
            // ... di dalam if (role === 'mahasiswa') ...

            $this->myLostReports = \App\Models\LostItem::with('category')
                ->where('user_id', auth()->id())

                // 1. Agar $lost->unread_count berfungsi
                ->withCount(['messages as unread_count' => function ($query) {
                    $query->where('receiver_id', auth()->id())
                        ->where('is_read', false);
                }])

                // 2. Agar $lost->messages_exists berfungsi (PENTING!)
                ->withExists('messages')

                ->latest()
                ->take(5)
                ->get();
        }
    }

    public function confirmMaintenanceToggle()
    {
        $this->confirmingMaintenance = true;
        $this->passwordConfirmation = ''; // Reset inputan
    }

    public function toggleMaintenance()
    {
        $user = auth()->user();

        // 1. LOGIKA VALIDASI
        // Jika google_id KOSONG, berarti User Biasa -> Wajib isi Password
        if (empty($user->google_id)) {
            $this->validate([
                'passwordConfirmation' => 'required',
            ]);

            if (!Hash::check($this->passwordConfirmation, $user->password)) {
                throw ValidationException::withMessages([
                    'passwordConfirmation' => __('Password yang Anda masukkan salah.'),
                ]);
            }
        }

        // 2. EKSEKUSI TOGGLE
        $setting = Setting::firstOrCreate(['key' => 'maintenance_mode']);

        // Balik nilai saat ini
        $newValue = ($setting->value === 'true') ? 'false' : 'true';
        $setting->update(['value' => $newValue]);

        // 3. Update Status Lokal (Agar UI langsung berubah warna)
        $this->isMaintenanceOn = ($newValue === 'true');

        cache()->forget('maintenance_mode');

        $this->confirmingMaintenance = false;
        $this->passwordConfirmation = '';

        $statusLabel = $this->isMaintenanceOn ? 'AKTIF' : 'NON-AKTIF';

        $this->dispatch(
            'show-toast',
            type: $this->isMaintenanceOn ? 'error' : 'success', // Merah jika aktif, Hijau jika mati
            message: "Maintenance Mode berhasil diubah menjadi: $statusLabel"
        );
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

        $this->returnedToday = found_items::where('status', 'selesai')
            ->whereDate('updated_at', now()->today())
            ->count();
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'title' => 'Dashboard',
            'totalUsers' => $this->totalUsers,
            'totalKategori' => categories::count(),
            'totalFound' => $this->totalFound,
            'returnedToday' => $this->returnedToday,
            'averageRating' => $this->averageRating,
            'userName' => auth()->user()->name,
        ]);
    }
}
