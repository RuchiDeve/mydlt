<?php

namespace App\Http\Livewire;

use App\Extensions\Sms\TextMessaging;
use App\Models\SmsPurchase;
use Livewire\Component;

class SmsBalanceCard extends Component
{

    public $balance;

    public $monthTotalPurchase;

    public function mount()
    {
        $this->fill([
            'balance' => TextMessaging::getSmsUnitBalance(),
            'monthTotalPurchase' => SmsPurchase::query()->where('approved', true)->sum('units')
        ]);
    }

    public function render()
    {
        return view('livewire.sms-balance-card');
    }
}
