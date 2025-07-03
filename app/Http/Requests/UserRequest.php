<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $current_path = url()->current();

        if($current_path === url('usercommit'))
        {
            return $this->getValidationList();
        }
        elseif($current_path === url('userupdate'))
        {
            return $this->getValidationList([
                'user'  => 'required',
                'email'             =>  'required|email|min:0|max:50,',
                'password'          =>  'nullable|min:8|max:16|same:confirm_password',
                'confirm_password'  =>  'nullable|min:8|max:16|same:password',
            ]);
        }
    }
        public function getValidationList($validation = [])
        {
            return $validation += [ 
                'name'              =>  'required|min:0|max:50',
                'fname'             =>  'required|min:0|max:50',
                'contact'           =>  'nullable|min:0|max:60',
                'cnic'              =>  'required|max:15|unique:users',
                'email'             =>  'required|email|unique:users|min:0|max:50,',
                'password'          =>  'required|min:8|max:16|same:confirm_password',
                'confirm_password'  =>  'required|min:8|max:16|same:password',
                'status'            =>  'required|in:Active,Deactive',
            ];
        }
    
    }
