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
            'name'          =>  'required|max:30',
            'address'       =>  'required|max:50',
            'district'      =>  'required|max:30',
            'province'      =>  'required|max:30',
            'state'         =>  'required|max:30',
            'phone'         =>  'required|digits_between:7,9|integer',
            'email'         =>  'required|max:50',
            'starTime'      =>  'required',
            'endTime'       =>  'required',
            'image'         =>  'required|image'
        ];
    }

}
