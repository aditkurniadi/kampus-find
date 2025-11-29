<?php

namespace App\Livewire\Admin;

use App\Models\Message;
use Livewire\Component;
use App\Models\LostItem;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class LostItemManager extends Component
{
    use WithPagination;

    public function updateStatus($id, $status)
    {
        $item = LostItem::find($id);
        if ($item) {
            $item->update(['status' => $status]);
        }
    }

    // Tambahan untuk konfirmasi delete via modal
    public $showDeleteModal = false;
    public $deleteId = null;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteItem($id = null)
    {
        $id = $id ?? $this->deleteId;

        $item = LostItem::find($id);
        if (! $item) {
            session()->flash('error', 'Laporan tidak ditemukan.');
            $this->showDeleteModal = false;
            $this->deleteId = null;
            return;
        }

        // Hapus semua file gambar chat terkait
        $messages = Message::where('lost_item_id', $item->id)->get();
        foreach ($messages as $msg) {
            if (!empty($msg->image_path)) {
                Storage::disk('public')->delete($msg->image_path);
            }
        }

        // Hapus data pesan dari DB
        Message::where('lost_item_id', $item->id)->delete();

        // Hapus foto laporan (lost item) dari storage jika ada
        if (!empty($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        // Hapus record lost item
        $item->delete();

        // Reset state modal / pagination
        $this->showDeleteModal = false;
        $this->deleteId = null;
        $this->resetPage();

        session()->flash('success', 'Laporan dan data terkait berhasil dihapus.');
    }

    public function render()
    {
        // Ambil paginator langsung di render — Livewire bisa me-return ini ke view tanpa menyimpan di properti publik
        $items = LostItem::with(['user', 'category'])->latest()->paginate(10);

        return view('livewire.admin.lost-item-manager', [
            'items' => $items
        ]);
    }
}
