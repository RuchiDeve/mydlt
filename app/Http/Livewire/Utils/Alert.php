<?php

namespace App\Http\Livewire\Utils;

use Livewire\Component;

class Alert extends Component
{

    protected $listeners = [
        'alert' => 'alert'
    ];

    public $show;

    public function mount()
    {
        $this->fill([
            'show' => false,
        ]);
    }

    public function alert()
    {
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.utils.alert');
    }
}
