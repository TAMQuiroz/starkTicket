<?php

namespace App\Http\Requests\Presentation;

use App\Http\Requests\Request;

class StorePresentationRequest extends Request
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'duration' => 'required',
            'reason' => 'required',
            'date_refund'   => 'required|date',
            'duration'   => 'required|numeric',
            'authorized' => 'required|numeric'
        ];
    }
}