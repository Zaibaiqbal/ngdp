<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RoleTableSeeder::class);

         $this->call(PermisionTableSeeder::class);

         $this->call(UserTableSeeder::class);

         $this->call(knowledgeThemeTableSeeder::class);

         $this->call(SdgTableSeeder::class);

         $this->call(TargetTableSeeder::class);
    }
}
