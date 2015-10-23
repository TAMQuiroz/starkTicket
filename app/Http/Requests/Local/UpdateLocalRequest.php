<?php

namespace App\Http\Requests\Local;

use App\Http\Requests\Request;

class UpdateLocalRequest extends Request
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
            'capacity'      =>  'required|min:0',
            'address'       =>  'required|max:50',
            'district'      =>  'required|max:20',
            'province'      =>  'required|max:20',
            'state'         =>  'required|max:20',
            'row'           =>  'min:0|required_with:column',
            'column'        =>  'min:0|required_with:row',
            'image'         =>  'image'
        ];
    }

}
