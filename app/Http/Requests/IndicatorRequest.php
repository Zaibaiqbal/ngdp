<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndicatorRequest extends FormRequest
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

        if($current_path === url('requirementcommit'))
        {
            return $this->getValidationList();
        }
        elseif($current_path === url('requirementupdate'))
        {
            return $this->getValidationList([
                'requirement'  => 'required',
            ]);
        }
    }

    public function getValidationList($validation = [])
    {
        return $validation += [
            'sub_theme'         => 'required',
        ];
    }
}
