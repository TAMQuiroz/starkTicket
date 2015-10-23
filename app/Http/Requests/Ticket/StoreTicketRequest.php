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
            'seats'             =>  'required',
            'event_id'          =>  'required',
            'presentation_id'   =>  'required',
            'seats'             =>  'required',
            'payMode'           =>  'required'
        ];
    }
}
