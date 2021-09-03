<?php

namespace App\Actions\Auth;


use App\Enums\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{



    public function register(array $payload)
    {
        $payload['password'] = Hash::make($payload['password']);

        /** @var User $user */
        $user = User::query()->create($payload);

        $user->assignRole(Roles::Member);

        return $user;
    }

}