<?php

namespace App\Http\Livewire;

use App\Models\Settings;
use Livewire\Component;
use Livewire\WithFileUploads;

class RenewDomainForm extends Component
{
    use WithFileUploads;

    public $domain_rate;

    public $proof;

    protected $rules = [
        'proof' => 'required|file|max:1024',
    ];


    /**
     * @param $property
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($property)
    {
        $this->validateOnly($property);
    }


    public function mount()
    {
        $this->fill([
            'domain_rate' => Settings::getDomainRate(),
        ]);
    }


    public function render()
    {
        return view('livewire.renew-domain-form');
    }
}
