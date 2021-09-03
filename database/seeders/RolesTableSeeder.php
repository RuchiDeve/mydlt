<?php

namespace Database\Seeders;

use App\Enums\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles_enums = Roles::getValues();

        foreach ($roles_enums as $role_enum){
            Role::create([
                'name' => $role_enum
            ]);
        }
    }
}
