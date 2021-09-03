<?php

namespace App\Http\Livewire;

use App\Models\SmsUsage;
use App\Models\User;
use Livewire\Component;

class SmsUsageList extends Component
{
    public $sms_usages;


    public function mount()
    {
        /** @var User $user */
        $user = auth()->user();

        if($user->isMember()){
            $this->sms_usages = SmsUsage::query()->where('user_id', $user->id)->get();
        } else {
            $this->sms_usages = SmsUsage::all();
        }
    }


    public function render()
    {
        return view('livewire.sms-usage-list');
    }
}
