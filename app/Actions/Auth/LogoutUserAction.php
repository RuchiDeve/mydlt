<?php

namespace App\Actions\Auth;


class LogoutUserAction
{

    public function logoutUser()
    {
        auth()->logout();
    }

}