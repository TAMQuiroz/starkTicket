<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'          => 'required',
            'image'         => 'required',
            'description'   => 'required',
            'father_id'     => 'exists:categories,id'
        ];
    }

    public function response(array $errors){
        
        $data = [
            'errors' => $errors
        ];

        return redirect()->back()->withInput()->withErrors($errors);
    }
}