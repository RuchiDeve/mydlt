<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'expires_at',
        'amount',
        'payment_proof',
        'approved'
    ];

    protected $dates = [
        'expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
