<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class SiteSettings extends Component
{
    use WithFileUploads;

    // Variabel untuk Upload Baru
    public $welcome_image;
    public $login_image;
    public $register_image;

    // Variabel untuk Preview Gambar Lama
    public $current_welcome;
    public $current_login;
    public $current_register;

    public $confirmingResetKey = null;

    public function confirmReset($key)
    {
        $this->confirmingResetKey = $key; // Simpan key (misal: 'welcome_image')
    }

    public function cancelReset()
    {
        $this->confirmingResetKey = null;
    }

    public function performReset()
    {
        if ($this->confirmingResetKey) {
            // Panggil fungsi resetImage yang sudah kita buat sebelumnya
            $this->resetImage($this->confirmingResetKey);

            // Tutup modal
            $this->confirmingResetKey = null;
        }
    }

    public function mount()
    {
        $this->current_welcome = Setting::where('key', 'welcome_image')->value('value');
        $this->current_login = Setting::where('key', 'login_image')->value('value');
        $this->current_register = Setting::where('key', 'register_image')->value('value');
    }

    public function save()
    {
        $this->validate([
            'welcome_image' => 'nullable|image|max:2048', // Max 2MB
            'login_image' => 'nullable|image|max:2048',
            'register_image' => 'nullable|image|max:2048',
        ]);

        $this->updateImage('welcome_image', $this->welcome_image);
        $this->updateImage('login_image', $this->login_image);
        $this->updateImage('register_image', $this->register_image);

        // Refresh data preview
        $this->mount();

        // Reset input file
        $this->reset(['welcome_image', 'login_image', 'register_image']);

        // Menggunakan Flux Toast atau session flash biasa
        $this->dispatch('show-toast', [
            'type' => 'success',
            'message' => 'Gambar website berhasil diperbarui!'
        ]);
    }

    private function updateImage($key, $newImage)
    {
        if ($newImage) {
            // Hapus gambar lama jika ada
            $oldImage = Setting::where('key', $key)->value('value');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            // Simpan gambar baru
            $path = $newImage->store('site-settings', 'public');

            // Update Database
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $path]
            );
        }
    }

    // [TAMBAHKAN METHOD INI]
    public function resetImage($key)
    {
        $setting = Setting::where('key', $key)->first();

        if ($setting && $setting->value) {
            // 1. Hapus file fisik dari storage agar tidak menuh-menuhin server
            if (Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }

            // 2. Hapus record dari database (sehingga helper akan otomatis pakai default)
            $setting->delete();
            // Atau jika Anda tidak ingin menghapus row-nya, gunakan: 
            // $setting->update(['value' => null]);
        }

        // 3. Reset input file sementara (jika user sempat pilih file tapi berubah pikiran)
        if ($key === 'welcome_image') $this->reset('welcome_image');
        if ($key === 'login_image') $this->reset('login_image');
        if ($key === 'register_image') $this->reset('register_image');

        // 4. Refresh tampilan (load ulang data dari DB)
        $this->mount();

        // 5. Notifikasi
        $this->dispatch('show-toast', [
            'type' => 'info',
            'message' => 'Gambar berhasil dikembalikan ke default.'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.site-settings');
    }
}
