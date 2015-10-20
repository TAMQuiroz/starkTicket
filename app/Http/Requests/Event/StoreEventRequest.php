<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules =  [
            'name'          => 'required|unique:categories|max:30',
            'image'         => 'required|image',
            'description'   => 'required',
            'category_id'   => 'required|exists:categories,id',
            'organizer_id'  => 'required|exists:organizers,id',
            'place_id'      => 'required|exists:places,id',
            ''
        ];
        foreach($this->request->get('zone_names') as $key=>$val)
        {
            $rules['zone_names.'.$key] = 'required|max:20';
            $rules['zone_capacity.'.$key] = 'required';
            $rules['zone_columns.'.$key] = 'numeric';// validation columns are lower than the one specified in the local
            $rules['zone_rows'.$key] = 'numeric';
            $rules['start_column'.$key] = 'numeric';
            $rules['start_row'.$key] ='numeric';
            foreach ($this->request->get('price'.$key) as $key2 => $value2) {
                $rules['price'.$key.$key2] = 'required|numeric'; //validation public id exists
            }
        }
        foreach($this->request->get('function_starts_at') as $key=>$val){
            $rules['function_starts_at'.$key] = 'required|date';
            $rules['function_ends_at'.$key] = 'required|date|after:function_starts_at';

        }
    }

    public function response(array $errors){
        
        $data = [
            'errors' => $errors
        ];

        return redirect()->back()->withInput()->withErrors($errors);
    }
}