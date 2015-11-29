<?php

namespace App\Http\Requests\Promotions;

use App\Http\Requests\Request;


class StorePromotionRequest extends Request
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
          
               
            'promotionName'  =>  'required|min:5|max:100',
            'fechaInicio'    =>  'required|date|max:20',
            'fechaFin'       =>  'required|date|max:20|after:fechaInicio',
            'description'    =>  'required|min:10|max:400',
            'discount'       =>  'numeric',
            'evento'         =>  'required|exists:events,id'
               


            


        ];




    }
}




