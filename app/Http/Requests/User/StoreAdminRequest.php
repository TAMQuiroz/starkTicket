<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

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
              'name' => 'required',
              'lastname' => 'required',
              'password' => 'required',
              'di_type' =>'required',
              'di' => 'required  ',
              'address' => 'required',
              'phone' => 'required',
              'email' => 'required|unique:users',
              'birthday' => 'required',
              'role_id' => 'required'
            
        ];
    }

    public function response(array $errors){
        
        $data = [
            'errors' => $errors
        ];

        return response()->json($data, 400);
    }   
}
