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
        'user_id',
        'category_id',
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
}
