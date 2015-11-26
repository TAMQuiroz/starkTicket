<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class StoreHighlightRequest extends Request
{
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules =  [
            'event_id'      => 'required|exists:events,id',
            'days'          => 'required|integer|max:30',
            'start_date'	=> 'required|date',
            ];
        return $rules;
    }
}