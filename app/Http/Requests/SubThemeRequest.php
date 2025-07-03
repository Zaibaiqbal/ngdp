<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubThemeRequest extends FormRequest
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

        if($current_path === url('subthemecommit'))
        {
            return $this->getValidationList();
        }
        elseif($current_path === url('subthemeupdate'))
        {
            return $this->getValidationList([
                'subtheme'  => 'required',

            ]);
        }
    }

    public function getValidationList($validation = [])
    {
        return $validation += [ 
            'name'      => 'required',
            'theme'     => 'required',

        ];
    }
}
