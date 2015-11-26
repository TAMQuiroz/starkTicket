<?php

namespace App\Http\Requests\Promotions;

use App\Http\Requests\Request;



class UpdatePromotionRequest extends Request
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
              

            'promotionName' =>  'required|max:50',
            'dateIni'       =>  'required|date|max:20',
            'dateEnd'       =>  'required|date|max:20|after:dateIni',
            'description'   =>  'required|max:300',
            'discount'      =>  'numeric'
      
               


        ];
    }
}




