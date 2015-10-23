<?php

namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class StoreOrganizerRequest extends Request
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
            'organizerName'          =>  'required',
            'organizerLastName'   =>  'required',
            'businessName'        =>  'required',
            'ruc'         =>  'required|numeric',
            'countNumber'          =>  'required|numeric',
            'telephone'   =>  'required|numeric',
            'dni'        =>  'required|numeric',
            'email'         =>  'required',
            'address'         =>  'required',
        ];

    }
}
