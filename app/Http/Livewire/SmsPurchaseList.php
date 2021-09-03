<?php

namespace App\Http\Livewire;

use App\Models\SmsPurchase;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class SmsPurchaseList extends Component
{

    public $sms_purchases;


    public function mount()
    {
        /** @var User $user */
        $user = auth()->user();

        if($user->isMember()){
            $this->sms_purchases = SmsPurchase::query()->where('user_id', $user->id)->get();
        } else {
            $this->sms_purchases = SmsPurchase::all();
        }
    }


    public function downloadProof($path)
    {
        return Storage::download($path);
    }


    public function approve($id)
    {
        /** @var SmsPurchase $sms_purchase */
        $sms_purchase = SmsPurchase::query()->where('id', $id)->first();

        $sms_purchase->update([
            'approved' => true,
        ]);

        /** @var User $member */
        $member = $sms_purchase->user;
        $member->creditSmsUnit($sms_purchase->units);

        $this->redirectRoute('app.sms');
    }


    public function render()
    {
        return view('livewire.sms-purchase-list');
    }
}
