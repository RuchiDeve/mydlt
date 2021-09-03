<?php

namespace App\Http\Livewire;

use App\Models\SmsPurchase;
use App\Models\User;
use Livewire\Component;

class MySmsBalance extends Component
{

    public $balance;

    public $monthTotalPurchase;

    public function mount()
    {
        /** @var User $user */
        $user = auth()->user();

        $this->fill([
            'balance' => $user->getSmsBalance(),
            'monthTotalPurchase' => SmsPurchase::query()
                ->where('user_id', $user->id)
                ->where('approved', true)
                ->sum('units')
        ]);
    }


    public function render()
    {
        return view('livewire.my-sms-balance');
    }
}
