<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\categories; // Sesuai nama model Anda
use App\Models\found_items; // Sesuai nama model Anda
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini
use Livewire\Attributes\On; // <-- Dan tambahkan ini

class FoundItems extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name;
    public $description;
    public $location_found;
    public $date_found;
    public $image;
    public $user_id;
    public $category_id;

    public $showModal = false;
    public $showModalEdit = false;
    public $showModalDelete = false;
    public $showModalComplete = false;
    public $showModalInfo = false;

    public $search = '';
    public $dateFilter = 'month';
    public $statusFilter = 'all';

    public $foundId;
    public $existingImage;

    public $taken_by_name;
    public $taken_by_npm;
    public $taken_by_phone;
    public $selectedItemId;

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
            'foundId',
            'existingImage',
        ]);
        $this->resetErrorBag();
    }

    public function openCreateModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showModalEdit = false;
        $this->showModalDelete = false;
        $this->showModalComplete = false;
        $this->showModalInfo = false;
        $this->resetFields();
        $this->reset(['name', 'taken_by_name', 'taken_by_npm', 'taken_by_phone']);
    }

    public function createData()
    {
        if (!auth()->check()) {
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

        $validatedData['user_id'] = auth()->id();

        if ($this->image) {
            $validatedData['image'] = $this->image->store('image/found', 'public');
        }

        found_items::create($validatedData);

        $this->dispatch('item-updated');
        $this->dispatch('show-toast', type: 'success', message: 'Data berhasil ditambahkan.');
        $this->closeModal();
    }

    public function openEditModal($id)
    {
        try {
            $item = found_items::findOrFail($id);
            $this->foundId = $item->id;
            $this->name = $item->name;
            $this->description = $item->description;
            $this->location_found = $item->location_found;

            $this->date_found = Carbon::parse($item->date_found)->format('Y-m-d');

            $this->category_id = $item->category_id;
            $this->existingImage = $item->image; // Simpan path gambar lama
            $this->image = null; // Reset input file

            $this->resetErrorBag();
            $this->showModalEdit = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function updateData()
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
            $item = found_items::findOrFail($this->foundId);

            if ($this->image) {
                $validatedData['image'] = $this->image->store('image/found', 'public');

                if ($this->existingImage && Storage::disk('public')->exists($this->existingImage)) {
                    Storage::disk('public')->delete($this->existingImage);
                }
            } else {
                unset($validatedData['image']);
            }

            // Update data di database
            $item->update($validatedData);

            $this->dispatch('item-updated');
            $this->dispatch('show-toast', type: 'success', message: 'Data berhasil diperbarui.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Gagal perbarui data: ' . $e->getMessage());
        }
    }

    public function openDeleteConfirm($foundId)
    {
        try {
            $foundItems = found_items::findOrFail($foundId);
            $this->name = $foundItems->name;
            $this->foundId = $foundItems->id;
            $this->showModalDelete = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function deleteFound()
    {
        try {
            $item = found_items::findOrFail($this->foundId);

            $imagePath = $item->image;

            $item->delete();

            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $this->dispatch('item-updated');
            $this->dispatch('show-toast', type: 'success', message: 'Data Berhasil di Hapus.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Gagal Hapus Data: ' . $e->getMessage());
        }
    }

    public function openCompleteModal($id)
    {
        $this->selectedItemId = $id;
        $this->reset(['taken_by_name', 'taken_by_npm', 'taken_by_phone']); // Bersihkan form
        $this->showModalComplete = true;
    }

    public function markAsCompleted()
    {
        // Validasi input
        $this->validate([
            'taken_by_name' => 'required|string|max:255',
            'taken_by_npm' => 'required|string|max:20',
            'taken_by_phone' => 'required|string|max:20',
        ]);

        $item = found_items::find($this->selectedItemId);

        if ($item) {
            $item->update([
                'status' => 'selesai',
                'taken_by_name' => $this->taken_by_name,
                'taken_by_npm' => $this->taken_by_npm,
                'taken_by_phone' => $this->taken_by_phone,
                // Opsional: 'taken_at' => now(), jika ada kolom tanggal pengambilan
            ]);

            $this->dispatch('show-toast', type: 'success', message: 'Barang berhasil diperbarui!.');
        }

        $this->closeModal();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function getFilterLabelProperty()
    {
        return match ($this->dateFilter) {
            'day' => 'Last day',
            'week' => 'Last 7 days',
            'month' => 'Last 30 days',
            'last_month' => 'Last month',
            'year' => 'Last year',
            default => 'All time',
        };
    }

    public function toggleStatus($id)
    {
        $item = found_items::find($id);
        if ($item) {
            // Logika toggle seperti biasa
            if ($item->status == 'available') {
                $item->status = 'selesai';
            } else {
                // Jika undo, kosongkan data pengambil
                $item->update([
                    'status' => 'available',
                    'taken_by_name' => null,
                    'taken_by_npm' => null,
                    'taken_by_phone' => null,
                ]);
            }
            $item->save();
            $this->dispatch('show-toast', type: 'success', message: 'Data berhasil diperbaru!.');
        }

        // Tutup semua modal setelah aksi
        $this->closeModal();
    }

    public function openInfoModal($id)
    {
        $item = found_items::find($id);

        if ($item) {
            $this->selectedItemId = $item->id;
            $this->name = $item->name; // Untuk ditampilkan di header modal
            $this->image = $item->image; // Untuk ditampilkan di header modal
            $this->taken_by_name = $item->taken_by_name;
            $this->taken_by_npm = $item->taken_by_npm;
            $this->taken_by_phone = $item->taken_by_phone;

            $this->showModalInfo = true;
        }
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function getStatusFilterLabelProperty()
    {
        return match ($this->statusFilter) {
            'available' => 'Tersedia',
            'selesai' => 'Selesai',
            'pending' => 'Pending',
            'rejected' => 'Rejected',
            default => 'all',
        };
    }

    /**
     * Render komponen.
     */
    public function render()
    {
        $categories = categories::all();
        $query = found_items::with('user', 'category');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhere('location_found', 'like', '%' . $this->search . '%');
            });
        }

        // Logika Filter Tanggal
        if ($this->dateFilter) {
            $query->where(function ($q) {
                match ($this->dateFilter) {
                    'day' => $q->whereDate('date_found', '>=', Carbon::now()->subDay()),
                    'week' => $q->whereDate('date_found', '>=', Carbon::now()->subDays(7)),
                    'month' => $q->whereDate('date_found', '>=', Carbon::now()->subDays(30)),
                    'last_month' => $q->whereBetween('date_found', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]),
                    'year' => $q->whereDate('date_found', '>=', Carbon::now()->subYear()),
                    default => null,
                };
            });
        }

        $query->when($this->statusFilter && $this->statusFilter != 'all', function ($q) {
            $q->where('status', $this->statusFilter);
        });

        $foundItems = $query->latest()->paginate(6);

        return view('livewire.found-items', [
            'title' => 'Found Items',
            'categories' => $categories,
            'userId' => auth()->check() ? auth()->user()->id : null,
            'foundItems' => $foundItems,
        ]);
    }
}
