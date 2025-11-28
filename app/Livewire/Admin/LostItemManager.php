<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\LostItem;
use Livewire\WithPagination;

class LostItemManager extends Component
{
    use WithPagination;

    public function updateStatus($id, $status)
    {
        $item = LostItem::find($id);
        $item->update(['status' => $status]);
        // Optional: Kirim notifikasi ke user bahwa status berubah
    }

    public function render()
    {
        return view('livewire.admin.lost-item-manager', [
            'items' => LostItem::with('user', 'category')->latest()->paginate(10)
        ]);
    }
}
