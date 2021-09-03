<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'units_used',
        'message',
        'recipients',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
