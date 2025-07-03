<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use DB;

class CustomRole extends Model
{
    public function storeSuperAdminPermission($user)
    {
        return DB::transaction(function () use ($user){

            $role = Role::findByName('Super Admin');

            if(isset($role->id))
            {
                $role->givePermissionTo('All');

                $user->assignRole('Super Admin');  
            }
        });
         
    }

    public function storeRole($data)
    {
        return DB::transaction(function () use ($data){

            
			$role = Role::create([
				'name' => $data['name']
			]);

            return with($role);

        });
    }

    public function verifyRole($user,$role_list)
    {
        return DB::transaction(function () use ($user,$role_list){

            $user->syncRoles($this->getUserRoles($user));

            if(@count($role_list) > 0)
            {
                $user->assignRole($role_list);

                return with(true);
            }
           

        });

    }

    public function getRoleById($id)
    {
    	return Role::find($id);
    }

    public function updateRole($data)
    {
        return DB::transaction(function () use ($data){

            $role = Role::find($data['role']);

            if(isset($role->id))
            {
            	$role->name =  $data['name'];

                $role->update();  
            }

            return with($role);

        });

    }

    public function removeRole($id)
    {
        return DB::transaction(function () use ($id){

            $flag = false;

            $role = Role::find($id);

            if(isset($role->id))
            {
                $role->delete();  

                $flag = true;
            }

            return with($flag);

        });
    }

    public function getRoleList()
    {
        return Role::whereNotIn('id',[1])->get();
    }

    public function getUserRoles($user)
    {
        return $user->hasAllRoles(Role::all());
    }


    
}
