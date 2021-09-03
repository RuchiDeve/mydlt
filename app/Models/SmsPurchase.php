<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'units',
        'amount',
        'payment_proof',
        'approved'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public static function getMyBalance(User $user)
    {
        return self::query()
            ->where('user_id', $user->id)
            ->where('approved', true)
            ->latest()
            ->first()
            ->units ?? 0;
    }
}
