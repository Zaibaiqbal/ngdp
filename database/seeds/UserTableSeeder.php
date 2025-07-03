<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => "Super User",
            'cnic' => "00000-0000000-0",
            'email' => "superuser@gisplus.net",
            'password' => Hash::make("11223344"),
            'type'  => "Super Admin"
        ]);

        $role = Role::findByName('Super Admin');

        if(isset($role->id))
        {
            $user->assignRole($role->name);

            $role->givePermissionTo('All');
        }

    }
}
