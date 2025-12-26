<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',      // 'reward', 'info', 'warning'
        'is_read',   // boolean (0 atau 1)
        'action_url' // Opsional: jika diklik lari ke link tertentu
    ];

    // Relasi: Setiap notifikasi milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
