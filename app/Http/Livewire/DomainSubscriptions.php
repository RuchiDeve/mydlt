<?php

namespace App\Http\Livewire;

use App\Models\DomainSubscription;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DomainSubscriptions extends Component
{

    public $subscriptions;


    public function mount()
    {
        /** @var User $user */
        $user = auth()->user();

        if($user->isMember()){
            $this->subscriptions = DomainSubscription::query()->where('user_id', $user->id)->get();
        } else {
            $this->subscriptions = DomainSubscription::all();
        }
    }


    public function downloadProof($path)
    {
        return Storage::download($path);
    }


    public function approve($subscription_id)
    {
        DomainSubscription::query()->where('id', $subscription_id)->update([
            'approved' => true,
            'expires_at' => now()->addYear()
        ]);

        $this->redirectRoute('app.domain');
    }


    public function render()
    {
        return view('livewire.domain-subscriptions');
    }
}
