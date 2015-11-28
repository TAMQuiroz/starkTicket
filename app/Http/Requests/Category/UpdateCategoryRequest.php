<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name'          => 'max:100|unique:categories,name,'.$this->input('id'),
            'image'         => 'image',
            'description'   => '',
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