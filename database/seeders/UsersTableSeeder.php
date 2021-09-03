<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();


        foreach ($roles as $role){

            $username = Str::lower(Str::slug($role->name));

            $email = $username . '@' . Str::lower(env('APP_DOMAIN', Str::slug(config('app.name')) . '.com'));

            /** @var User $user */
            $user = User::query()->create([
                'name' => $role->name,
                'username' => $username,
                'email' => $email,
                'phone' => '08060935051',
                'password' => Hash::make('secret'),
            ]);

            $user->assignRole($role);
        }

    }
}
