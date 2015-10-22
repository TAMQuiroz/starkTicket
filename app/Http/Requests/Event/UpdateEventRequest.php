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
            'name'          => 'required|max:30',
            'image'         => 'image',
            'description'   => 'required',
            'category_id'   => 'required|exists:categories,id',
            'organizer_id'  => 'required|exists:organizers,id',
            'local_id'      => 'required|exists:locals,id',
            'zone_names'    => 'required',
            'price'         => 'required',
            'function_starts_at' => 'required',
            'function_ends_at'   => 'required',
            'publication_date'   => 'required|date',
            'selling_date'       => 'required|date|after:publication_date'
        ];
        $zones = $this->request->get('zone_names'); 
        if($zones)
        foreach($zones as $key=>$val)
        {
            $rules['zone_names.'.$key]      = 'required|max:20';
            $rules['zone_capacity.'.$key]   = 'numeric|min:1|required_without:zone_columns.'.$key;
            $rules['zone_columns.'.$key]    = 'numeric|min:1|required_without:zone_capacity.'.$key;// validation columns are lower than the one specified in the local
            $rules['zone_rows.'.$key]       = 'numeric|min:1|required_with:zone_columns.'.$key;
            $rules['start_column.'.$key]    = 'numeric|min:1|required_with:zone_columns.'.$key;
            $rules['start_row.'.$key]       = 'numeric|min:1|required_with:zone_columns.'.$key;
            $rules['price.'.$key]           = 'required|numeric|min:0';
        }
        $presentations = $this->request->get('function_starts_at');
        if($presentations)
        foreach($presentations as $key=>$val){
            $rules['function_starts_at.'.$key]  = 'required|date';
            $rules['function_ends_at.'.$key]    = 'required|date|after:function_starts_at.'.$key;

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