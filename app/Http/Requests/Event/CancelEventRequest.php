<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class CancelEventRequest extends Request
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'duration'    => 'required|integer|min:1',
            'reason'      => 'required',
            'date_refund' => 'required|date'
        ];
    }
}