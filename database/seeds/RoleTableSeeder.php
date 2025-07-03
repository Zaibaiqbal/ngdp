<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = -1;

        $data[++$count] = [  "name" => 'Super Admin','guard_name' => 'web', 'created_at' => now()];

        Role::insert($data);


    }
}
