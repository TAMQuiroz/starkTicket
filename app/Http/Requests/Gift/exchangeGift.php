<?php

namespace App\Http\Requests\Gift;

use App\Http\Requests\Request;
use App\Models\Gift;
use App\User;
class exchangeGift extends Request
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
       $rules = [

            'nombre_de_usuario'          =>  'required|exists:users,id',
 'gifts'          =>  'required|exists:gifts,id',

        ];
     


    return $rules ;
    }
}
