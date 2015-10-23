<?php

namespace App\Http\Requests\Gift;

use App\Http\Requests\Request;

class UpdateGiftRequest extends Request
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
            'name'          =>  'required|max:30|alpha_num',
            'description'   =>  'required|max:100|alpha_num',
            'points'        =>  'required|number',
            'stock'         =>  'required|number',
            'image'         =>  'image'
        ];
    }

}
