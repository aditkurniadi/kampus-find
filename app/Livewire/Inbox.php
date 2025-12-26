<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class Inbox extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    // Variabel untuk menyimpan notifikasi yang sedang dibuka detailnya
    public $selectedNotification = null;

    // Fungsi untuk membuka detail pesan
    public function showDetail($id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if ($notification) {
            $this->selectedNotification = $notification;

            // Otomatis tandai sudah dibaca saat dibuka
            if (!$notification->is_read) {
                $notification->update(['is_read' => true]);
                $this->dispatch('notification-updated'); // Update ikon lonceng
            }
        }
    }

    // Fungsi tutup detail
    public function closeDetail()
    {
        $this->selectedNotification = null;
    }

    public function markAllRead()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $this->dispatch('notification-updated');
        $this->dispatch('show-toast', type: 'success', message: 'Semua pesan ditandai sudah dibaca.');
    }

    public function delete($id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if ($notification) {
            // Jika yang dihapus adalah yang sedang dibuka, tutup modalnya
            if ($this->selectedNotification && $this->selectedNotification->id == $id) {
                $this->closeDetail();
            }

            $notification->delete();
            $this->dispatch('show-toast', type: 'success', message: 'Pesan dihapus.');
        }
    }

    public function render()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('livewire.inbox', [
            'notifications' => $notifications
        ]);
    }
}
