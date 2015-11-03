<?php

namespace App\Http\Requests\Ticket;

use App\Http\Requests\Request;

class StoreTicketRequest extends Request
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
            'quantity'          =>  'required|integer',
            'event_id'          =>  'required|integer',
            'zone_id'           =>  'required|integer',
            'promotion_id'      =>  'integer',
            'user_id'           =>  'integer',
            'presentation_id'   =>  'required|integer',
            'payMode'           =>  'required|integer'
        ];
    }
}
