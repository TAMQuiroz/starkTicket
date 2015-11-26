<?php

namespace App\Http\Requests\Organizer;

use App\Http\Requests\Request;

class UpdateOrganizerRequest extends Request
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
            'organizerName'          =>  'required|max:100',
            'organizerLastName'   =>  'required|max:100',
            'businessName'        =>  'required|max:100',
            'ruc'         =>  'required|numeric|integer|digits:11',
            'countNumber'          =>  'required|numeric|integer',
            'telephone'   =>  'required|numeric|integer|digits_between:7,9',
            'dni'        =>  'required|numeric|integer|digits:8',
            'email'         =>  'required',
            'address'         =>  'required|max:100',
        ];
    }
}
