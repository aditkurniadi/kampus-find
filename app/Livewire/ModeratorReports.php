<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\found_items; // Pastikan nama model Anda benar
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ModeratorReports extends Component
{
    use WithPagination;

    public $search = '';
    public $showModalDelete = false;
    public $showModalReject = false;
    public $showModalApprove = false;

    public $itemId;
    public $name;
    public $rejectionReason = '';
    public $selectedItem = null;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModalDelete = false;
        $this->showModalReject = false;
        $this->showModalApprove = false;
        $this->itemId = null;
        $this->name = '';
        $this->rejectionReason = '';
        $this->selectedItem = null;
        $this->resetErrorBag(); // Menghapus pesan error validasi
    }

    public function openApproveConfirm($id)
    {
        try {
            // Ambil data lengkap dengan relasi untuk ditampilkan di modal
            $this->selectedItem = found_items::with('user', 'category')->findOrFail($id);
            $this->itemId = $id; // Simpan ID untuk dieksekusi
            $this->showModalApprove = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    /**
     * [BARU] Fungsi yang dipanggil tombol 'Konfirmasi' di modal approve
     */
    public function confirmApprove()
    {
        if (!$this->itemId) return; // Keamanan jika ID tidak ada

        try {
            $item = found_items::findOrFail($this->itemId);

            // Setujui dan catat siapa admin yang menangani
            $item->update([
                'status' => 'available',
                'handled_by_user_id' => Auth::id(),
                'rejection_reason' => 'Terima kasih atas laporan anda!'
            ]);

            $this->dispatch('show-toast', type: 'success', message: 'Laporan "' . $item->name . '" telah disetujui.');
            $this->closeModal(); // Tutup semua modal

        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'danger', message: 'Gagal menyetujui laporan.');
        }
    }

    public function approveReport($id)
    {
        try {
            $item = found_items::findOrFail($id);
            $item->update(['status' => 'available']);
            $this->dispatch('show-toast', type: 'success', message: 'Laporan "' . $item->name . '" telah disetujui.');
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'danger', message: 'Gagal menyetujui laporan.');
        }
    }

    public function openRejectConfirm($id)
    {
        try {
            $item = found_items::findOrFail($id);
            $this->itemId = $item->id;
            $this->name = $item->name; // Menggunakan $name
            $this->showModalReject = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function rejectReport()
    {
        $this->validate(['rejectionReason' => 'required|string|min:10']);

        try {
            $item = found_items::findOrFail($this->itemId); // Asumsi Anda sudah ganti ke itemId

            // 2. MODIFIKASI FUNGSI UPDATE INI
            $item->update([
                'status' => 'rejected',
                'rejection_reason' => $this->rejectionReason,
                'handled_by_user_id' => Auth::id() // <-- TAMBAHKAN BARIS INI
            ]);

            $this->dispatch('show-toast', type: 'success', message: 'Laporan "' . $item->name . '" telah ditolak.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'danger', message: 'Gagal menolak laporan.');
        }
    }

    public function openDeleteConfirm($id)
    {
        try {
            $item = found_items::findOrFail($id);
            $this->itemId = $item->id;
            $this->name = $item->name; // Menggunakan $name
            $this->showModalDelete = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function deleteFound()
    {
        try {
            $item = found_items::findOrFail($this->itemId);
            $imagePath = $item->image;
            $itemName = $item->name;

            $item->delete();

            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $this->dispatch('show-toast', type: 'success', message: 'Laporan "' . $itemName . '" telah dihapus permanen.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'danger', message: 'Gagal menghapus laporan.');
        }
    }

    public function render()
    {
        $query = found_items::with('user', 'category')
            ->where('status', 'pending'); // HANYA tampilkan yang PENDING

        $query->whereHas('user', function ($q) {
            $q->where('role', 'mahasiswa');
        });

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($userQuery) {
                        $userQuery->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        $pendingReports = $query->latest()->paginate(10);

        return view('livewire.moderator-reports', [
            'reports' => $pendingReports,
        ]);
    }
}
