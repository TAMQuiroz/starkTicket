<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\Request;

class StoreBookingRequest extends Request
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
            'event_id'          =>  'required|integer|exists:events,id',
            'zone_id'           =>  'required|integer|exists:zones,id',
            'promotion_id'      =>  'integer',
            'presentation_id'   =>  'required|integer|exists:presentations,id',
            'dni_recojo'        =>  'numeric|digits:8'
            //'payMode'           =>  'required|integer'
        ];
    }
}