<?php

use App\Models\LostItem;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{lostItemId}', function ($user, $lostItemId) {
    $lostItem = LostItem::find($lostItemId);

    // --- TAMBAHKAN PENGECEKAN INI ---
    // Jika barang tidak ditemukan (misal sudah dihapus), tolak akses
    if (!$lostItem) {
        return false;
    }
    // --------------------------------

    // Izinkan jika user adalah Superadmin/Keamanan ATAU Pemilik Barang
    return $user->role === 'superadmin' ||
        $user->role === 'keamanan' ||
        $user->id === $lostItem->user_id;
});
