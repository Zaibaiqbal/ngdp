<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $count = -1;

        // GENERAL PERMISSIONS
        $data[++$count] = [ "module" => NULL, "name" => "All", "guard_name" => "web"];
        // END GENERAL PERMISSION

        // NEW PERMISSION 
        $module = 'Gender Statistics';

        $data[++$count] = [ "module" => $module, "name" => "Edit Portal", "guard_name" => "web"];

        $data[++$count] = [ "module" => $module, "name" => "View Portal", "guard_name" => "web"];


        // $data[++$count] = [ "module" => $module, "name" => "Edit Portal", "guard_name" => "web"];


        // $data[++$count] = [ "module" => $module, "name" => "View Portal", "guard_name" => "web"];            
        //END 

        // NEW PERMISSION 
        $module = 'Knowledge Hub';

        $data[++$count] = [ "module" => $module, "name" => "Add / Edit / Delete Data", "guard_name" => "web"];

        $data[++$count] = [ "module" => $module, "name" => "View Data", "guard_name" => "web"];

        $data[++$count] = [ "module" => $module, "name" => "Download Data", "guard_name" => "web"];

            
        //END 

        // NEW PERMISSION 
        $module = 'Administration';

        $data[++$count] = [ "module" => $module, "name" => "Add Roles", "guard_name" => "web"];

        $data[++$count] = [ "module" => $module, "name" => "Update Roles", "guard_name" => "web"];  

        // $data[++$count] = [ "module" => $module, "name" => "R Roles", "guard_name" => "web"];  


        $data[++$count] = [ "module" => $module, "name" => "Change Roles", "guard_name" => "web"];

        $data[++$count] = [ "module" => $module, "name" => "Registered Users", "guard_name" => "web"];  // USER LIST REPLACE WITH REGISTERED USERS

        $data[++$count] = [ "module" => $module, "name" => "Approve / Reject Users", "guard_name" => "web"]; // MOVE RIGHT SIDE BAR AND RENAME APPROVE / REJECT USERS

        $data[++$count] = [ "module" => $module, "name" => "Change Password", "guard_name" => "web"];  

        $data[++$count] = [ "module" => $module, "name" => "View Logs", "guard_name" => "web"];            

        //END

      

        Permission::insert($data);
    }

}
