<?php

namespace App\Http\Requests\Politics;

use App\Http\Requests\Request;


class UpdatePoliticRequest extends Request
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
            'name'          =>  'required|max:70',
            'description'       =>  'required|max:300',
            'state'      =>  'required|max:20'

        ];

    }
}
