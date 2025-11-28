<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Message extends Model
{
    // --- TAMBAHKAN INI ---
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'lost_item_id',
        'message',
        'image_path',
        'is_read',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
