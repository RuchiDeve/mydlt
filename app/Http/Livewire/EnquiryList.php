<?php

namespace App\Http\Livewire;

use App\Models\Enquiry;
use App\Models\User;
use Livewire\Component;

class EnquiryList extends Component
{
    protected $enquiries;

    public function mount()
    {


    }


    public function render()
    {
        /** @var User $user */
        $user = auth()->user();

        if($user->isMember()){
            $this->enquiries = Enquiry::query()->where('user_id', $user->id)->paginate(20);
        } else {
            $this->enquiries = Enquiry::query()->paginate(20);
        }

        return view('livewire.enquiry-list')
            ->with('enquiries', $this->enquiries);
    }
}
