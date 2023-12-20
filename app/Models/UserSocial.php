<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSocial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'telegram',
        'vk',
        'facebook',
        'instagram',
        'viber',
        'whatsapp',
        'youtube',
        'tiktok',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
