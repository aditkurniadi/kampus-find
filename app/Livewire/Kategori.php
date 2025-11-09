<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\categories;
use Illuminate\Validation\Rule;

class Kategori extends Component
{
    public $name;
    public $slug;

    public $showModal = false;
    public $showModalEdit = false;
    public $showModalDelete = false;

    public $userId = '';

    public $search = '';

    public function createKategori()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|min:3',
            'slug' => 'required|string|min:3|unique:categories,slug',
        ]);

        categories::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
        ]);

        $this->dispatch('user-updated');
        $this->dispatch('show-toast', type: 'success', message: 'Data berhasil ditambahkan.');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showModalEdit = false;
        $this->showModalDelete = false;

        $this->reset([
            'name',
            'slug',
        ]);
        $this->resetErrorBag();
    }

    public function openCreateModal()
    {
        $this->reset();
        $this->showModal = true;
    }

    public function openEditModal($userId)
    {
        try {
            $kategori = categories::findOrFail($userId);
            $this->name = $kategori->name;
            $this->slug = $kategori->slug;
            $this->userId = $kategori->id;
            $this->showModalEdit = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'danger', message: 'Data tidak ditemukan.');
        }
    }

    public function updateKategori()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|min:3',
            'slug' => 'required|' . Rule::unique('categories')->ignore($this->userId),
        ]);

        try {
            $kategori = categories::findOrFail($this->userId);

            $updateData = [
                'name' => $validatedData['name'],
                'slug' => $validatedData['slug'],
            ];

            $kategori->update($updateData);

            $this->dispatch('user-updated');
            $this->dispatch('show-toast', type: 'success', message: 'Data Berhasuil di Update.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'danger', message: 'Data gagal di Update.');
        }
    }

    public function openDeleteConfirm($userId)
    {
        try {
            $kategori = categories::findOrFail($userId);
            $this->name = $kategori->name;
            $this->userId = $kategori->id;
            $this->showModalDelete = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function deleteKategori()
    {
        try {
            categories::findOrFail($this->userId)->delete();
            $this->dispatch('user-updated');
            $this->dispatch('show-toast', type: 'success', message: 'Data Berhasil di Hapus.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'warning', message: 'Gagal Hapus Data User.');
        }
    }


    public function render()
    {
        return view('livewire.kategori', [
            // 'users' => User::latest()->get(),
            'categories' => categories::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
                ->latest()
                ->paginate(10), // <-- Gunakan paginate()
        ]);
    }
}
