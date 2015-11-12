<?php

namespace App\Http\Requests\Attendance;

use App\Http\Requests\Request;

class AttendanceUpdate extends Request
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
          //Unicamente actualizamos la hora en que un vendedor finalizo su dia
            'horaFin'      =>  'max:20|date_format:H:m'  
               
        ];
    }
}
