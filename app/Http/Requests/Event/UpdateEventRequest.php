<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class UpdateEventRequest extends Request
{
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules =  [
            'name'          => 'max:30',
            'image'         => 'image',
            'description'   => '',
            'category_id'   => 'exists:categories,id',
            'zone_names'    => '',
            'function_starts_at' => '',
            'function_ends_at'   => ''
        ];
        $zones = $this->request->get('zone_names'); 
        if($zones)
            foreach($zones as $key=>$val)
            {
                $rules['zone_names.'.$key]      = 'max:20';
                $rules['zone_capacity.'.$key]   = '';
                $rules['zone_columns.'.$key]    = 'numeric';// validation columns are lower than the one specified in the local
                $rules['zone_rows.'.$key]       = 'numeric';
                $rules['start_column.'.$key]    = 'numeric';
                $rules['start_row.'.$key]       = 'numeric';
                $rules['price.'.$key]           = 'numeric';
            }
        $presentations = $this->request->get('function_starts_at');
        if($presentations)
            foreach($presentations as $key=>$val){
                $rules['function_starts_at.'.$key]  = 'date';
                $rules['function_ends_at.'.$key]    = 'date|after:function_starts_at.'.$key;
            }
        return $rules;
    }

    public function response(array $errors){
        
        $data = [
            'errors' => $errors
        ];

        //return response()->json($data, 400);

        return redirect()->back()->withInput()->withErrors($errors);
    }
}