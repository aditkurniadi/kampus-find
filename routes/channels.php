<?php

use App\Models\LostItem;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{lostItemId}', function ($user, $lostItemId) {
    $lostItem = LostItem::find($lostItemId);

    if (!$lostItem) {
        return false;
    }

    // Perbaikan: Lakukan type casting untuk memastikan perbandingan ID
    $isOwner = (int)$user->id === (int)$lostItem->user_id; // <-- Perbaikan
    $isAdmin = in_array($user->role, ['superadmin', 'keamanan']);

    return $isAdmin || $isOwner; // <-- Gunakan logika yang lebih bersih
});
