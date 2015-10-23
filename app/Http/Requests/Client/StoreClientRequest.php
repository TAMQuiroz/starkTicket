<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Request;

class StoreClientRequest extends Request
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
            'name' => 'required|min:3|max:16',
            'lastname' => 'required|min:3|max:16',
            'password' => 'required|min:8|max:16',
            'di_type' => 'required|digits_between:0,2',
            'di' => 'required|min:8|max:16',
            'email' => 'required|min:12|max:32',
            'birthday' => 'required|date'
        ];
    }

}
