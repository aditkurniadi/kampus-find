<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Users extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;

    public $showModal = false;
    public $showModalEdit = false;
    public $showModalDelete = false;

    public $userId = '';

    public $search = '';

    public function createUser()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $this->dispatch('user-updated');
        $this->dispatch('show-toast', type: 'success', message: 'User created successfully.');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showModalEdit = false;
        $this->showModalDelete = false;

        $this->reset([
            'name',
            'email',
            'password',
            'userId',
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
            $user = User::findOrFail($userId);
            $this->name = $user->name;
            $this->email = $user->email;
            $this->userId = $user->id;
            $this->password = null;
            $this->showModalEdit = true;
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'danger', message: 'Data tidak ditemukan.');
        }
    }

    public function updateUser()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|' . Rule::unique('users')->ignore($this->userId),
            'role' => 'required',
            'password' => 'nullable|string|min:6',
        ]);

        try {
            $user = User::findOrFail($this->userId);

            $updateData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'],
            ];

            if (!empty($validatedData['password'])) {
                $updateData['password'] = Hash::make($validatedData['password']);
            }

            $user->update($updateData);

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
            $user = User::findOrFail($userId);
            $this->name = $user->name;
            $this->userId = $user->id;
            $this->showModalDelete = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Data tidak ditemukan.');
            $this->dispatch('show-toast', type: 'warning', message: 'Data tidak ditemukan!');
        }
    }

    public function deleteUser()
    {
        try {
            User::findOrFail($this->userId)->delete();
            $this->dispatch('user-updated');
            $this->dispatch('show-toast', type: 'success', message: 'Data Berhasil di Hapus.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('show-toast', type: 'danger', message: 'Gagal Hapus Data User.');
        }
    }


    public function render()
    {
        return view('livewire.users', [
            // 'users' => User::latest()->get(),
            'users' => User::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
                ->latest()
                ->paginate(10), // <-- Gunakan paginate()
        ]);
    }
}
