<?php

namespace App\Http\Livewire\Settings;

use App\Models\User;
use Livewire\Component;

class UserProfileSettingsForm extends Component
{

    /** @var User */
    public $user;

    protected $rules = [
        'user.name' => 'required|string',
        'user.phone' => 'required|numeric',
        'user.email' => 'required|string|email',
//        'user.username' => 'required|string|min:4',
    ];

    public function mount()
    {
        $this->fill([
            'user' => auth()->user()
        ]);
    }


    public function updateProfile()
    {
        $payload = $this->validate()['user'];


        $this->dispatchBrowserEvent('notification', [
            'type' => 'loading',
            'message' => 'Updating profile'
        ]);

        $this->user->fill($payload);

        $this->user->save();


        $this->dispatchBrowserEvent('notification', [
            'type' => 'toast',
            'message' => 'Profile updated!',
            'messageType' => 'success'
        ]);

    }

    public function render()
    {
        return view('livewire.settings.user-profile-settings-form');
    }
}
