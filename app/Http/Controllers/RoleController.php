<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\User;
use App\CustomRole;
use App\CustomPermission;


class RoleController extends Controller
{
	public $flag;
	public $message;

	public function __construct()
    {
        $this->flag = '';
        $this->message = '';

    }

    public function getValidationList($validation = [])
	{
		$this->flag = 'fail';
		$this->message = 'Required form validations.';

		return $validation + [

			'name' 	=> 'required|unique:roles|string|min:1|max:50',

		];
	}

	public function index()
	{
		$role = new CustomRole;

		$role_list = $role->getRoleList();


		return view('roles_permissions.manage_roles',[
			'role_list' => $role_list
		]);
	}

	public function storeRole(Request $request)
	{

		$request->validate($this->getValidationList());

		$collect_data = $request->input();


		$role = new CustomRole;

		$role = $role->storeRole($collect_data);

		if(isset($role->id))
		{
			$this->flag = 'success';
			$this->message = 'Role has been added successfully.';
		}

		return redirect()->back()->with($this->flag,$this->message);

	}

    public function updateRole(Request $request)
    {
    	try{

    		if($request->isMethod('post'))
			{
                $role_id = decrypt($request->role);

				$request->validate($this->getValidationList([
                    'name' => [
                        'required',Rule::unique('roles')->ignore($role_id),
                        ],
                ]));

				$collect_data = $request->input();

				$collect_data['role'] = $role_id;

				$role = new CustomRole;

				$role = $role->updateRole($collect_data);

				if(isset($role->id))
				{
					$this->flag = 'success';
					$this->message = 'Role has been updated successfully.';
				}
			}
            else
            {
                $id = decrypt($request->id);

                $role = new CustomRole;

                $role = $role->getRoleById($id);

                if(isset($role->id))
                {
                    return view('roles_permissions.modals.update_role',[

                        'role' => $role,

                    ])->render();
                }
                else
                {
                    $this->flag = 'fail';
                    $this->message = 'Record not found.';
                }
            }




		}
        catch (DecryptException $e)
        {

        }

        return redirect()->back()->with($this->flag,$this->message);

    }

    public function removeRole($id)
    {
    	try{

    		$id = decrypt($id);

			$role = new CustomRole;


			if($role->removeRole($id))
			{
				$this->flag = 'success';
				$this->message = 'Role has been removed successfully.';
			}


		}
        catch (DecryptException $e)
        {

        }

        return redirect()->back()->with($this->flag,$this->message);

    }

    public function getPermissionList($id)
    {
    	try{

    		$id = decrypt($id);

    		$role = new CustomRole;

    		$role = $role->getRoleById($id);

    		if(isset($role->id))
    		{
    			$permission = new CustomPermission;

    			return view('roles_permissions.assign_permission',[
    				'module_list' => $permission->getDistinctPermissionByColumn('module'),
    				'role'	=> $role,
                    'permission' => $permission,
    			]);
    		}
    	}
        catch (DecryptException $e)
        {

        }
    }

    public function verifyPermissionByRole(Request $request)
    {
    	try{

    		$request->validate([

    			'permission' => 'required',
    			'role' 		 => 'required',

    		]);


    		$role       = decrypt($request->role);
    		$permission = decrypt($request->permission);
    		$option     = $request->option;

    		$custom_permission = new CustomPermission;

    		return $custom_permission->verifyPermissionByRole($role,$permission);

    	}
        catch (DecryptException $e)
        {

        }

        return 0;
    }

    public function getRoleList($id)
    {
        try{

            $id = decrypt($id);

            $user = new User;


            $user = $user->getUserById($id);

            if(isset($user->id))
            {
                $role = new CustomRole;

                return view('roles_permissions.assign_roles',[
                    'role_list' => $role->getRoleList(),
                    'user'      => $user,

                ]);
            }
        }
        catch (DecryptException $e)
        {

        }
    }

    public function verifyRoleByUser(Request $request)
    {
        try{

            $request->validate([

                'user' => 'required',
                'role'       => 'required',

            ]);


            $role_id       = decrypt($request->role);

            $user_id       = decrypt($request->user);

            $user = new User;

            $user = $user->getUserById($user_id);

            if(isset($user->id))
            {
               $role = new CustomRole;

                return $role->verifyRole($user,$role_id);
            }

        }
        catch (DecryptException $e)
        {

        }

        return 0;
    }
}
