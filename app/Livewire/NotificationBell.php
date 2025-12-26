<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    // Listener: Jika ada event 'notification-updated' (dari Inbox.php), jalankan render ulang
    protected $listeners = ['notification-updated' => '$refresh'];

    public function render()
    {
        // Hitung jumlah pesan yang BELUM DIBACA saja
        $unreadCount = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return view('livewire.notification-bell', compact('unreadCount'));
    }
}
