<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithPagination;

class AnnouncementManager extends Component
{
    use WithPagination;

    // Properti untuk Form
    public $title;
    public $content;
    public $isActive = true; // Default pengumuman langsung aktif
    public $announcementId;

    // Properti untuk Modal
    public $showModal = false;
    public $showModalEdit = false;
    public $showModalDelete = false;

    // Tema pagination
    protected $paginationTheme = 'tailwind';

    // Aturan Validasi
    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'isActive' => 'required|boolean',
        ];
    }

    // Mereset field form
    public function resetFields()
    {
        $this->reset(['title', 'content', 'announcementId']);
        $this->isActive = false; // Set default ke true
        $this->resetErrorBag();
    }

    // --- CREATE DATA ---

    public function openCreateModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function createData()
    {
        $validatedData = $this->validate();

        // [PERBAIKAN] Ganti nama key 'isActive' menjadi 'is_active'
        $validatedData['is_active'] = $validatedData['isActive'];
        unset($validatedData['isActive']); // Hapus key 'isActive' yang salah

        // Tambahkan user_id dari user yang sedang login
        $validatedData['user_id'] = auth()->id();

        Announcement::create($validatedData); // Sekarang ini akan berhasil

        $this->dispatch('show-toast', type: 'success', message: 'Pengumuman berhasil ditambahkan.');
        $this->closeModal();
    }

    // --- EDIT DATA ---

    public function openEditModal($id)
    {
        try {
            $item = Announcement::findOrFail($id);
            $this->announcementId = $item->id;
            $this->title = $item->title;
            $this->content = $item->content;
            $this->isActive = $item->is_active; // Ambil status dari database

            $this->resetErrorBag();
            $this->showModalEdit = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function updateData()
    {
        $validatedData = $this->validate();

        try {
            $item = Announcement::findOrFail($this->announcementId);

            // Ubah nama key agar cocok dengan kolom database
            $validatedData['is_active'] = $validatedData['isActive'];
            unset($validatedData['isActive']); // Hapus key lama

            $item->update($validatedData);

            $this->dispatch('show-toast', type: 'success', message: 'Pengumuman berhasil diperbarui.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Gagal perbarui data.');
        }
    }

    // --- DELETE DATA ---

    public function openDeleteConfirm($id)
    {
        try {
            $item = Announcement::findOrFail($id);
            $this->announcementId = $item->id;
            $this->title = $item->title; // Untuk ditampilkan di modal konfirmasi
            $this->showModalDelete = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function deleteData()
    {
        try {
            Announcement::findOrFail($this->announcementId)->delete();
            $this->dispatch('show-toast', type: 'success', message: 'Pengumuman berhasil dihapus.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Gagal menghapus data.');
        }
    }

    // --- MODAL CONTROL ---

    public function closeModal()
    {
        $this->showModal = false;
        $this->showModalEdit = false;
        $this->showModalDelete = false;
        $this->resetFields();
    }

    public function toggleStatus($itemId)
    {
        try {
            $item = Announcement::findOrFail($itemId);

            // Logika untuk membalik status (toggle)
            $item->is_active = !$item->is_active;
            $item->save();

            $message = $item->is_active ? 'Pengumuman diaktifkan.' : 'Pengumuman dinonaktifkan.';
            $this->dispatch('show-toast', type: 'success', message: $message);

            // Livewire akan me-render ulang komponen secara otomatis
            // dan menampilkan status baru di tabel.

        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Gagal mengubah status.');
        }
    }

    // --- RENDER ---

    public function render()
    {
        $announcements = Announcement::with('user')
            ->latest()
            ->paginate(10);

        return view('livewire.announcement-manager', [
            'announcements' => $announcements
        ]);
    }
}
