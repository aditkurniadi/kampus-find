<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\LostItem;
use App\Models\categories;
use App\Models\Message;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class MyLostItems extends Component
{
    use WithPagination, WithFileUploads;

    // Modal states
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    // Form fields
    public $item_name;
    public $category_id;
    public $description;
    public $location;
    public $photo;
    public $existingImage;

    // Edit/Delete
    public $selectedItemId;

    // Search & Filter
    public $search = '';
    public $statusFilter = 'all';

    protected $paginationTheme = 'tailwind';

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function openEditModal($id)
    {
        $item = LostItem::findOrFail($id);

        // Cek akses
        if ($item->user_id !== auth()->id()) {
            $this->dispatch('show-toast', type: 'error', message: 'Anda tidak memiliki akses untuk mengedit laporan ini.');
            return;
        }

        $this->selectedItemId = $item->id;
        $this->item_name = $item->item_name;
        $this->category_id = $item->category_id;
        $this->description = $item->description;
        $this->location = $item->location;
        $this->existingImage = $item->image_path;
        $this->photo = null;

        $this->showEditModal = true;
    }

    public function openDeleteModal($id)
    {
        $item = LostItem::findOrFail($id);

        // Cek akses
        if ($item->user_id !== auth()->id()) {
            $this->dispatch('show-toast', type: 'error', message: 'Anda tidak memiliki akses untuk menghapus laporan ini.');
            return;
        }

        $this->selectedItemId = $id;
        $this->showDeleteModal = true;
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'item_name',
            'category_id',
            'description',
            'location',
            'photo',
            'existingImage',
            'selectedItemId'
        ]);
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'location' => 'required|string',
            'photo' => 'nullable|image|max:2048', // Max 2MB
        ]);

        $imagePath = null;
        if ($this->photo) {
            $imagePath = $this->photo->store('lost-items', 'public');
        }

        LostItem::create([
            'user_id' => auth()->id(),
            'item_name' => $this->item_name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'location' => $this->location,
            'image_path' => $imagePath,
            'status' => 'dicari',
        ]);

        $this->dispatch('show-toast', type: 'success', message: 'Laporan kehilangan berhasil dibuat.');
        $this->closeModal();
    }

    public function update()
    {
        $this->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'location' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $item = LostItem::findOrFail($this->selectedItemId);

        // Cek akses
        if ($item->user_id !== auth()->id()) {
            $this->dispatch('show-toast', type: 'error', message: 'Anda tidak memiliki akses untuk mengedit laporan ini.');
            return;
        }

        $imagePath = $item->image_path;
        if ($this->photo) {
            // Hapus gambar lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $this->photo->store('lost-items', 'public');
        }

        $item->update([
            'item_name' => $this->item_name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'location' => $this->location,
            'image_path' => $imagePath,
        ]);

        $this->dispatch('show-toast', type: 'success', message: 'Laporan kehilangan berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete()
    {
        $item = LostItem::findOrFail($this->selectedItemId);

        // Cek akses
        if ($item->user_id !== auth()->id()) {
            $this->dispatch('show-toast', type: 'error', message: 'Anda tidak memiliki akses untuk menghapus laporan ini.');
            return;
        }

        // Hapus gambar jika ada
        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        // Hapus pesan terkait
        Message::where('lost_item_id', $item->id)->delete();

        $item->delete();

        $this->dispatch('show-toast', type: 'success', message: 'Laporan kehilangan berhasil dihapus.');
        $this->closeModal();
    }

    public function render()
    {
        $query = LostItem::where('user_id', auth()->id())
            ->with('category')
            ->withCount(['messages as unread_count' => function ($q) {
                $q->where('receiver_id', auth()->id())->where('is_read', false);
            }])
            ->withExists('messages');

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('item_name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        // Filter status
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        $items = $query->latest()->paginate(10);

        return view('livewire.mahasiswa.my-lost-items', [
            'items' => $items,
            'categories' => categories::all(),
        ]);
    }
}
