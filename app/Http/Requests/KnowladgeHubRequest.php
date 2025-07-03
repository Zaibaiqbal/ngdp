<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ExistRule;


class KnowladgeHubRequest extends FormRequest
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

        if($current_path === url('commitknowladge'))
        {
            return $this->getValidationList();
        }
        elseif($current_path === url('knowladgeupdate'))
        {
            if($this->isMethod('post'))
            {
                return $this->getValidationList([
                    'knowladge_hub'  => 'required',
                ]);

            }
            else
            {
                return [];
            }


        }
        else if($current_path === url('commitarticle'))
        {
            return [

                 'title'             => 'required|min:1|max:255',
                 'source'            => 'required|min:1',
                 'pdf'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',
                // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
                 'knowledge_theme'             => ['required', new ExistRule('knowledge_themes','id')]
            ];
        }
        elseif($current_path === url('articleupdate'))
        {
            if($this->isMethod('post'))
            {
                 return [

                 'title'             => 'required|min:1|max:255',
                 'source'            => 'required|min:1',
                 'pdf'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',

                // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
                 'knowledge_theme'             => ['required', new ExistRule('knowledge_themes','id')]
            ];

            }
            else
            {
                return [];
            }


        }
        else if($current_path === url('commitdataset'))
        {
            return [

                 'title'             => 'required|min:1|max:255',
                 'source'            => 'nullable|min:1',
                 'summary'           => 'nullable|min:1',
                 'pdf'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',

                 // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
                 'knowledge_theme'   => ['required', new ExistRule('knowledge_themes','id')]

            ];
        }
        elseif($current_path === url('datasetupdate'))
        {
            if($this->isMethod('post'))
            {
                 return [

                 'title'             => 'required|min:1|max:255',
                 'source'            => 'nullable|min:1',
                 'summary'           => 'nullable|min:1',
                 'pdf'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',

                 // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
                 'knowledge_theme'             => ['required', new ExistRule('knowledge_themes','id')]
            ];

            }
            else
            {
                return [];
            }


        }

         else if($current_path === url('commitlawregulations'))
        {
            return [

                 'title'             => 'required|min:1|max:255',
                 'source'            => 'required|min:1',
                 'summary'           => 'nullable|min:1',
                 'pdf'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',
                 // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
                 'knowledge_theme'   => ['required', new ExistRule('knowledge_themes','id')]

            ];
        }
        elseif($current_path === url('lawregulationsupdate'))
        {
            if($this->isMethod('post'))
            {
                 return [

                 'title'             => 'required|min:1|max:255',
                 'source'            => 'required|min:1',
                 'summary'           => 'nullable|min:1',
                 'pdf'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',

                 // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
                 'knowledge_theme'             => ['required', new ExistRule('knowledge_themes','id')]
            ];

            }
            else
            {
                return [];
            }


        }

        else if($current_path === url('commitinfographic'))
        {
            return [

            'image'      => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:10000',
            'title'             => 'required|min:1|max:255',

            // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
            'knowledge_theme'             => ['required', new ExistRule('knowledge_themes','id')],
            'source'            => 'required|min:1',



            ];
        }
        else if($current_path === url('updateinfographic'))
        {
            if($this->isMethod('post'))
            {
                return [

                  'image'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',
                    'title'             => 'required|min:1|max:255',

                    // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
                    'knowledge_theme'             => ['required', new ExistRule('knowledge_themes','id')],
                    'source'            => 'required|min:1',



                    ];
            }


            return [];

        }
        else if($current_path === url('commitotherknowledge'))
        {
            return [

                 'title'             => 'required|min:1|max:255',
                 'type'              => 'required',
                 'source'            => 'required|min:1',
                 'pdf'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',
                // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
                 'knowledge_theme'             => ['required', new ExistRule('knowledge_themes','id')]
            ];
        }
        elseif($current_path === url('otherknowledgeupdate'))
        {
            if($this->isMethod('post'))
            {
                 return [

                 'title'             => 'required|min:1|max:255',
                 'type'              => 'required',
                 'source'            => 'required|min:1',
                 'pdf'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',


                // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
                 'knowledge_theme'             => ['required', new ExistRule('knowledge_themes','id')]
            ];

            }
            else
            {
                return [];
            }


        }
    }

    public function getValidationList($validation = [])
    {
        return $validation += [

            'thumbnail'         => 'nullable|mimes:jpeg,png,jpg|max:2000',
            'pdf'               => 'nullable|mimes:pdf,PDF,jpeg,png,jpg,docs,docx,xls,xlxs,csv|max:100000',
            'title'             => 'required|min:1|max:255',
            'organization'      => 'nullable|min:0|max:255',
            'summary'           => 'nullable',
            'publication_date'  => 'nullable',
            'source'            => 'nullable|min:0',
            'author'            => 'nullable|min:1|max:100',
            // 'sub_theme'         => ['required', new ExistRule('sub_themes','id')],
            'knowledge_theme'   => ['required', new ExistRule('knowledge_themes','id')]

        ];
    }



}
