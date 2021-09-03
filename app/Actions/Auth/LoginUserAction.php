<?php

namespace App\Actions\Auth;


class LoginUserAction
{

    public function login(array $credentials)
    {
        if (auth()->attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('app.dashboard');
        }
    }

}