<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CurrentSubscription extends Component
{
    public $currentSub;

    public function mount()
    {
        /** @var User $user */
        $user = request()->user();

        $this->fill([
            'currentSub' => $user->getCurrentSubscription()
        ]);

    }


    public function render()
    {
        return view('livewire.current-subscription');
    }
}
