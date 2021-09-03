<?php

namespace App\Http\Livewire;

use App\Models\Settings;
use Livewire\Component;
use Livewire\WithFileUploads;

class BuySmsForm extends Component
{
    use WithFileUploads;

    public $sms_rate;

    public $units;


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
            'sms_rate' => Settings::getSmsRate(),
            'units' => 1
        ]);
    }

    public function getCostProperty()
    {
        return $this->sms_rate * doubleval($this->units);
    }

    public function render()
    {
        return view('livewire.buy-sms-form');
    }
}
