<?php

namespace App\Http\Requests\ExchangeRate;

use App\Http\Requests\Request;

class StoreExchangeRateRequest extends Request
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
            'buyingRate'    =>  'required|numeric',
            'sellingRate'   =>  'required|numeric',
        ];
    }

}
