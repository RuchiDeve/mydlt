<?php

namespace App\Models;

use App\Enums\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'password',
        'sms_unit_balance',
    ];

    public function getSmsBalance()
    {
        return$this->sms_unit_balance;
    }

    public function getSmsQuota()
    {
        return $this->sms_quota;
    }

    public function deductSmsUnit($unit)
    {
        $this->sms_unit_balance -= $unit;
        $this->save();
    }

    public function creditSmsUnit($unit)
    {
        $this->sms_unit_balance += $unit;
        $this->save();
    }

    public function canAffordUnit($unit)
    {
        return $this->sms_unit_balance >= $unit;
    }


    public function isSuperAdmin()
    {
        return $this->hasRole(Roles::SuperAdmin);
    }

    public function isMember()
    {
        return $this->hasRole(Roles::Member);
    }

    public function isDeveloper()
    {
        return $this->hasRole(Roles::Developer);
    }


    public function domainSubscriptions()
    {
        return $this->hasMany(DomainSubscription::class, 'user_id');
    }


    public function hasPendingRenewals()
    {
        return $this->domainSubscriptions()->where('approved', false)->exists();

    }

    public function hasActiveSubscription()
    {
        return $this->domainSubscriptions()
            ->groupBy(['user_id', 'domain_subscriptions.id'])
            ->havingRaw('domain_subscriptions.id = MAX(domain_subscriptions.id)')
            ->where('approved', true)
            ->whereDate('expires_at', '>=', now())
            ->exists();
    }

    public function getCurrentSubscription()
    {
        return $this->domainSubscriptions()
            ->groupBy(['user_id', 'domain_subscriptions.id'])
            ->havingRaw('domain_subscriptions.id = MAX(domain_subscriptions.id)')
            ->where('approved', true)
            ->whereDate('expires_at', '>=', now())
            ->first();

    }


    public function getMemberSmsUnitBalance()
    {
        return $this->sms_unit_balance;
    }

    public function smsPurchases()
    {
        return $this->hasMany(SmsPurchase::class, 'user_id');
    }

    public function hasPendingPurchases()
    {
        return $this->smsPurchases()->where('approved', false)->exists();
    }


    public function getDomainLink()
    {
        return route('domain.page', ['member' => $this->username]);
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function changeUserPassword($current_password, $new_password)
    {
        if(password_verify($current_password, $this->password)){
            return $this->updatePassword($new_password);
        }

        return false;
    }

    public function updatePassword($password, $withAttributes = [])
    {
        $this->forceFill([
            'password' => bcrypt($password)
        ]);

        if (!empty($withAttributes)){
            $this->forceFill($withAttributes);
        }

        $this->save();

        return $this;
    }
}
