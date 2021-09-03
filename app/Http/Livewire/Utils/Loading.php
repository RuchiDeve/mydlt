<?php

namespace App\Http\Livewire\Utils;

use Livewire\Component;

class Loading extends Component
{

    public $message;

    public function mount($message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return view('livewire.utils.loading');
    }
}
