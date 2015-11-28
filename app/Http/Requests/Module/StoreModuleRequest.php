<?php

namespace App\Http\Requests\Module;

use App\Http\Requests\Request;

class StoreModuleRequest extends Request
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
            'name'          =>  'required|max:100',
            'address'       =>  'required|max:100',
            'district'      =>  'required|max:100',
            'province'      =>  'required|max:100',
            'state'         =>  'required|max:100',
            'phone'         =>  'required|digits_between:7,9|integer',
            'email'         =>  'required|max:100',
            'starTime'      =>  'required',
            'endTime'       =>  'required',
            'image'         =>  'required|image'
        ];
    }

}
