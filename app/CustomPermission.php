<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use DB;


class CustomPermission extends Model
{
    public function getPermissionList()
    {
    	return Permission::orderBy('id','ASC')->get();
    }

    public function getDistinctPermissionByColumn($column)
    {
    	return Permission::where($column,'!=',NULL)->distinct($column)->get([$column]);
    }

    public function getPermissionByModule($module)
    {
    	return Permission::where(['module' => $module])->orderBy('id','ASC')->get();
    }

    public function verifyPermissionByRole($role,$permission)
    {
    	return DB::transaction(function () use ($role,$permission){

    		$custom_role = new CustomRole;

    		$custom_role = $custom_role->getRoleById($role);

    		if(isset($custom_role->id))
    		{
    			$custom_permission = Permission::find($permission);

    			if(isset($custom_permission->id))
    			{
    				if(!$custom_role->hasPermissionTo($custom_permission))
    				{
    					$custom_role->givePermissionTo($custom_permission);

    					return with(1);
    				}
    				else
    				{
    					$custom_role->revokePermissionTo($custom_permission);

    					return with(2);
    				}
    			}

    		}

    		return with(0);

        });
    }
}
