<?php

namespace App\Http\Requests\Module;

use App\Http\Requests\Request;

class UpdateModuleRequest extends Request
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
        return [
            'name'          =>  'required|max:15',
            'address'       =>  'required|max:50',
            'district'      =>  'required|max:20',
            'province'      =>  'required|max:20',
            'state'         =>  'required|max:20',
            'phone'         =>  'required|max:15',
            'email'         =>  'required|max:30',
            'starTime'      =>  'required',
            'endTime'       =>  'required',
            'image'         =>  'image'
        ];
    }

}
