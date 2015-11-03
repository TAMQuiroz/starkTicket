<?php

namespace App\Http\Requests\Local;

use App\Http\Requests\Request;

class StoreLocalRequest extends Request
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
            'district'      =>  'required|max:20',
            'province'      =>  'required|max:20',
            'state'         =>  'required|max:20',
            'local_type'    =>  'required',
            'capacity'      =>  'required_if:local_type,2|min:0',
            'row'           =>  'min:0|required_if:local_type,1|required_with:column',
            'column'        =>  'min:0|required_if:local_type,1|required_with:row',
            'image'         =>  'required|image'
        ];
    }

}
