<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Request;

class UpdateClientRequest extends Request
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
            'name'     => 'required|min:3|max:16',
            'lastname' => 'required|min:3|max:30',
            'address'  => 'required|min:3|max:100',
            'phone'    => 'required|integer|min:7|max:9',
            //'email' => 'required|email|unique:users',
            'email'    => 'required|email',
        ];
    }

}
