<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\found_items;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;
use Livewire\Attributes\Layout; // <-- 1. TAMBAHKAN IMPORT INI

#[Layout('layouts.public')] // <-- 2. TAMBAHKAN ATTRIBUTE INI
class GaleriPage extends Component
{
    use WithPagination;

    // Properti ini akan menyimpan nilai filter secara real-time
    public $search = '';
    public $date_filter = 'all';

    public $showDetailModal = false;
    public $selectedItem;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    // Kita gunakan tema pagination yang cocok dengan Tailwind
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        // ... (Logika render $data Anda yang sudah ada) ...

        $query = found_items::with('user', 'category')->where('status', 'available');

        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location_found', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($catQuery) use ($search) {
                        $catQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($this->date_filter != 'all') {
            $filter = $this->date_filter;
            if ($filter == 'today') {
                $query->whereDate('date_found', Carbon::today());
            } elseif ($filter == 'week') {
                $query->where('date_found', '>=', Carbon::now()->subDays(7));
            } elseif ($filter == 'month') {
                $query->where('date_found', '>=', Carbon::now()->subDays(30));
            }
        }

        $data = $query->latest()->paginate(9);

        return view('livewire.galeri-page', [
            'data' => $data,
        ]);
    }

    /**
     * [BARU] Membuka modal detail.
     */
    public function openDetailModal($itemId)
    {
        try {
            // Kita ambil data lengkap termasuk relasi 'user' (penemu)
            $this->selectedItem = found_items::with('user')->findOrFail($itemId);
            $this->showDetailModal = true;
        } catch (\Exception $e) {
            // Item tidak ditemukan, tidak melakukan apa-apa
        }
    }

    public function closeModal()
    {
        $this->showDetailModal = false;
        $this->selectedItem = null; // Kosongkan data
    }
}
