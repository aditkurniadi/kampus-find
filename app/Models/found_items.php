<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class found_items extends Model
{
    protected $table = 'found_items';

    protected $fillable = [
        'name',
        'description',
        'location_found',
        'date_found',
        'image',
        'status',
        'rejection_reason',
        'user_id',
        'category_id',
        'handled_by_user_id',

        'taken_by_name',
        'taken_by_npm',
        'taken_by_phone',
        'taken_at',
    ];

    protected $casts = [
        'date_found' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(categories::class);
    }

    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by_user_id');
    }

    // --- TAMBAHKAN INI ---
    public function messages()
    {
        // Relasi ke tabel 'messages', foreign key 'lost_item_id'
        // (Asumsi kita menggunakan 'lost_item_id' di tabel messages untuk merujuk ke barang ini)
        return $this->hasMany(Message::class, 'lost_item_id');
    }
}
