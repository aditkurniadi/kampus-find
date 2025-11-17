<?php

namespace App\Livewire; // Perhatikan namespace 'Student'

use Livewire\Component;
use App\Models\categories; // Sesuai nama model Anda
use App\Models\found_items; // Sesuai nama model Anda
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Menggunakan Auth facade

class MyReports extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Properti untuk Form (Sama seperti FoundItems)
    public $name;
    public $description;
    public $location_found;
    public $date_found;
    public $image;
    public $user_id;
    public $category_id;

    // Properti untuk Modal
    public $showModal = false;
    public $showModalEdit = false;
    public $showModalDelete = false;

    // Properti untuk Filter & Search
    public $search = '';
    // Kita tidak perlu filter tanggal di sini

    // Properti untuk Edit & Delete
    public $reportId; // Mengganti nama 'foundId' agar lebih jelas
    public $existingImage;

    public $showRejectionModal = false;
    public $selectedItem;

    // ========================================================================
    // FUNGSI HELPER (Resetting)
    // ========================================================================

    /**
     * Helper untuk me-reset field form.
     */
    public function resetFields()
    {
        $this->reset([
            'name',
            'description',
            'location_found',
            'date_found',
            'image',
            'category_id',
            'user_id',
            'reportId',
            'existingImage',
        ]);
        $this->resetErrorBag();
    }

    /**
     * Membuka modal create.
     */
    public function openCreateModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    /**
     * Menutup semua modal.
     */
    public function closeModal()
    {
        $this->showModal = false;
        $this->showModalEdit = false;
        $this->showModalDelete = false;
        $this->showRejectionModal = false; // <-- Tambahkan ini
        $this->selectedItem = null;
        $this->resetFields();
    }

    // ========================================================================
    // FUNGSI CREATE (Buat Laporan)
    // ========================================================================

    public function createReport()
    {
        if (!Auth::check()) {
            $this->dispatch('show-toast', type: 'error', message: 'Silakan login terlebih dahulu.');
            return;
        }

        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_found' => 'required|string|max:255',
            'date_found' => 'required|date',
            'image' => 'nullable|image|max:5120', // 5MB
            'category_id' => 'required|exists:categories,id',
        ]);

        // KUNCI 1: Set user_id dari user yang sedang login
        $validatedData['user_id'] = Auth::id();

        // KUNCI 2: Set status otomatis ke 'pending'
        $validatedData['status'] = 'pending';

        // Proses upload gambar
        if ($this->image) {
            $validatedData['image'] = $this->image->store('image/found', 'public');
        }

        found_items::create($validatedData);

        $this->dispatch('show-toast', type: 'success', message: 'Laporan berhasil dikirim. Menunggu verifikasi Admin.');
        $this->closeModal();
    }

    // ========================================================================
    // FUNGSI EDIT & UPDATE
    // ========================================================================

    public function openEditModal($id)
    {
        try {
            $item = found_items::findOrFail($id);

            // KUNCI 3: Pastikan user hanya bisa edit laporannya sendiri
            if ($item->user_id !== Auth::id()) {
                $this->dispatch('show-toast', type: 'danger', message: 'Akses ditolak.');
                return;
            }

            // KUNCI 4: Pastikan user hanya bisa edit jika status 'pending'
            if ($item->status !== 'pending') {
                $this->dispatch('show-toast', type: 'info', message: 'Laporan ini sudah diverifikasi dan tidak bisa diubah lagi.');
                return;
            }

            $this->reportId = $item->id;
            $this->name = $item->name;
            $this->description = $item->description;
            $this->location_found = $item->location_found;
            $this->date_found = Carbon::parse($item->date_found)->format('Y-m-d');
            $this->category_id = $item->category_id;
            $this->existingImage = $item->image;
            $this->image = null;

            $this->resetErrorBag();
            $this->showModalEdit = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function updateReport()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_found' => 'required|string|max:255',
            'date_found' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:5120',
        ]);

        try {
            $item = found_items::findOrFail($this->reportId);

            // KUNCI KEAMANAN: Cek ulang kepemilikan & status
            if ($item->user_id !== Auth::id() || $item->status !== 'pending') {
                $this->dispatch('show-toast', type: 'danger', message: 'Akses ditolak atau data sudah diverifikasi.');
                return;
            }

            // Logika handle gambar
            if ($this->image) {
                $validatedData['image'] = $this->image->store('image/found', 'public');
                if ($this->existingImage && Storage::disk('public')->exists($this->existingImage)) {
                    Storage::disk('public')->delete($this->existingImage);
                }
            } else {
                unset($validatedData['image']);
            }

            $item->update($validatedData);

            $this->dispatch('show-toast', type: 'success', message: 'Laporan berhasil diperbarui.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Gagal perbarui data.');
        }
    }

    // ========================================================================
    // FUNGSI DELETE (Hapus Laporan)
    // ========================================================================

    public function openDeleteConfirm($id)
    {
        try {
            $item = found_items::findOrFail($id);

            if ($item->user_id !== Auth::id()) {
                $this->dispatch('show-toast', type: 'danger', message: 'Akses ditolak.');
                return;
            }

            $this->name = $item->name;
            $this->reportId = $item->id;
            $this->showModalDelete = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function deleteReport()
    {
        try {
            $item = found_items::findOrFail($this->reportId);

            // KUNCI KEAMANAN: Cek ulang kepemilikan
            if ($item->user_id !== Auth::id()) {
                $this->dispatch('show-toast', type: 'danger', message: 'Akses ditolak.');
                return;
            }

            // Mahasiswa boleh hapus kapan saja (pending, available, atau claimed)
            // Jika Anda ingin membatasi (misal: hanya boleh hapus saat pending), tambahkan cek status di sini.

            $imagePath = $item->image;
            $item->delete();

            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $this->dispatch('show-toast', type: 'success', message: 'Laporan Berhasil di Hapus.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Gagal Hapus Data.');
        }
    }

    public function openRejectionDetails($itemId)
    {
        try {
            $this->selectedItem = found_items::where('user_id', Auth::id())
                ->with('handler') // Load data admin yang handle
                ->findOrFail($itemId);

            $this->showRejectionModal = true; // Buka modal baru

        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'danger', message: 'Gagal memuat detail laporan.');
        }
    }

    // ========================================================================
    // FUNGSI RENDER (Tampilan)
    // ========================================================================

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = categories::all();

        // KUNCI UTAMA: Hanya ambil data milik user yang sedang login
        $query = found_items::with('category') // 'user' tidak perlu, karena sudah pasti milik dia
            ->where('user_id', Auth::id());

        // Logika Search (hanya mencari di data miliknya)
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('location_found', 'like', '%' . $this->search . '%');
            });
        }

        $myItems = $query->latest()->paginate(10);

        return view('livewire.my-reports', [
            'title' => 'Laporan Saya',
            'categories' => $categories,
            'myItems' => $myItems, // Mengganti nama variabel agar tidak bentrok
        ]);
    }
}
