<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password;

    public $retype_password;

    public $new_password;

    public $changed;

    /**
     * @var User
     */
    public $user;

    protected $rules = [
        'current_password' => 'required|string',
        'new_password' => 'required|same:retype_password',
        'retype_password' => 'required'
    ];


    /**
     * @param $property
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($property){
        $this->validateOnly($property);
    }

    public function changePassword()
    {
        $payload = $this->validate();

        $this->changed = !!$this->user->changeUserPassword($payload['current_password'], $payload['new_password']);

        $this->reset();
    }

    public function mount()
    {
        $this->fill([
            'user' => request()->user(),
            'changed' => false,
        ]);
    }

    public function render()
    {
        return view('livewire.auth.change-password');
    }
}
