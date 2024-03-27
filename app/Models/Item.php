<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'status',
        'user_id',
        'image',
    ];

     /**
     * Get the user that owns the phone.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute($value)
    {
        if (!empty($value)) {
            return Storage::url($value);
        }
        return null;
    }
}
