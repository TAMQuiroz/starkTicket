<?php

namespace App\Http\Requests\Giveaway;

use App\Http\Requests\Request;

class StoreGiveawayRequest extends Request
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
            'sale_id'      => 'required|exists:tickets,id',
            'designee'     => 'required|integer|digits:8',
        ];
    }
}
