<?php

namespace App\Http\Livewire\Auth;

use App\Actions\Auth\LoginUserAction;
use Livewire\Component;

class Login extends Component
{

    public $username;

    public $password;

    public function doLogin()
    {

        (new LoginUserAction())->login([
            'username' => $this->username,
            'password' => $this->password,
        ]);

        if (auth()->check()){
            $this->emitTo('utils.alert', 'alert');
            return redirect()->intended('/app/dashboard');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
