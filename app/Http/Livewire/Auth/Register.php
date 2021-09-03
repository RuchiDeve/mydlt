<?php

namespace App\Http\Livewire\Auth;

use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\RegisterUserAction;
use Livewire\Component;

use App\Models\User;

class Register extends Component
{

    /**
     * @var User
     */
    public $user;

    public $confirm_password;

    /**
     * @var boolean
     */
    public $registered = false;

    protected $rules = [
        'user.name' => 'required|string',
        'user.phone' => 'required|numeric',
        'user.password' => 'required|string|same:confirm_password',
        'user.email' => 'required|string|email|unique:users,email',
        'user.username' => 'required|string|min:4|unique:users,username',
    ];

    /**
     * @param $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function doRegistration()
    {
        flash()->info('validating');

        $payload = $this->validate()['user'];

        $this->user = (new RegisterUserAction())->register($payload);

        $this->registered = true;


        (new LoginUserAction())->login([
            'username' => $payload['username'],
            'password' => $payload['password'],
        ]);

        $this->reset();

        return redirect()->intended('/app/dashboard');

    }


    public function render()
    {

        return view('livewire.auth.register');
    }
}
