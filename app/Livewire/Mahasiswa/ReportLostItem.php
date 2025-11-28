<?php

namespace App\Livewire\Mahasiswa;

use Livewire\Component;
use App\Models\LostItem;
use App\Models\categories;
use Livewire\WithFileUploads;

class ReportLostItem extends Component
{
    use WithFileUploads;

    public $item_name;
    public $category_id;
    public $description;
    public $location;
    public $photo;

    public function save()
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

        // Flash message & Redirect
        session()->flash('toast', ['type' => 'success', 'message' => 'Laporan kehilangan berhasil dibuat. Admin akan segera memeriksa.']);
        return $this->redirect(route('dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.mahasiswa.report-lost-item', [
            'categories' => categories::all()
        ]);
    }
}
