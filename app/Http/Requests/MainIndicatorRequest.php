<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainIndicatorRequest extends FormRequest
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
        if($current_path === url('indicatorinfocommit'))
        {
            return $this->getValidationList();
        }
      
    }

    public function getValidationList($validation = [])
    {
        return $validation += [
            'indicator_id'         => 'required',
            'survey_level'         => 'required',
            'province_id'          => 'required_if:survey_level,==,Province'
        ];
    }
}
