<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Services\FileService;

class StoreAdminRequest extends Request
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
        //   
              'name' => 'required|max:100',
              'lastname' => 'required|max:100',
              'password' => 'required',
              'di_type' =>'required',
              'di' => 'required|numeric|integer|digits:8',
              'address' => 'required|max:100',
              'phone' => 'required|numeric|integer|digits_between:7,9',
              'email' => 'required|unique:users',
              'birthday' => 'date|required',
              'role_id' => 'required',
            
        ];
    }
}
