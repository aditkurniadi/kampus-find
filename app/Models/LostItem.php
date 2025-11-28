<?php

namespace App\Models;

use App\Models\User;
use App\Models\categories;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LostItem extends Model
{
    protected $fillable = [
        'user_id',
        'item_name',
        'category_id',
        'description',
        'location',
        'image_path',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(categories::class, 'category_id');
    }

    public function messages()
    {
        // Relasi: Satu Barang Hilang punya BANYAK Pesan
        return $this->hasMany(Message::class, 'lost_item_id');
    }
}
