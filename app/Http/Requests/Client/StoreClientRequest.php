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
            'address' => 'required|min:3|max:16',
            'phone' => 'required|min:7|max:9',
            'di_type' => 'required|digits_between:0,2',
            'di' => 'required|min:8|max:16',
            'email' => 'required|email',
            'birthday' => 'required|date',
            'password_confirmation' => 'required|same:password'
        ];
    }

}
