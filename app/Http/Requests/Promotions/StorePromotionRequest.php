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
          
               
            'promotionName'          =>  'required|min:5|max:50',
            'dateIni'       =>  'required|max:20',
            'dateEnd'      =>  'required|max:20',
            'description'      =>  'required|min:10|max:400',
            'discount'      =>  'numeric',
            'evento'      =>  'required|exists:events,id'
               


            


        ];




    }
}




