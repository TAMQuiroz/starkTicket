<?php

namespace App\Http\Requests\Event;

use App\Http\Requests\Request;

class StoreEventRequest extends Request
{
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules =  [
            'yesterday'     => 'date',
            'name'          => 'required|max:30',
            'image'         => 'required|image',
            'distribution_image' => 'image',
            'description'   => 'required|max:100',
            'time_length'   => 'required|numeric|min:1',
            'category_id'   => 'required|exists:categories,id',
            'organizer_id'  => 'required|exists:organizers,id',
            'local_id'      => 'required|exists:locals,id',
            'zone_names'    => 'required',
            'price'         => 'required',
            'start_date'    => 'required',
            'start_time'    => 'required',
            'publication_date'   => 'required|date|after:yesterday',
            'selling_date'       => 'required|date'
        ];
        $zones = $this->request->get('zone_names'); 
        if($zones)
        foreach($zones as $key=>$val)
        {
            $rules['zone_names.'.$key]      = 'required|max:30';
            $rules['zone_capacity.'.$key]   = 'integer|min:1|required_without:zone_columns.'.$key.',zone_rows.'.$key.',start_column.'.$key.',start_row.'.$key;
            $rules['zone_columns.'.$key]    = 'integer|min:1|required_with:zone_rows.'.$key.',start_row.'.$key.',start_column.'.$key.'|required_without_all:zone_capacity.'.$key;// validation columns are lower than the one specified in the local
            $rules['zone_rows.'.$key]       = 'integer|min:1|required_with:zone_columns.'.$key.',start_row.'.$key.',start_column.'.$key.'|required_without_all:zone_capacity.'.$key;
            $rules['start_column.'.$key]    = 'integer|min:1|required_with:zone_columns.'.$key.',start_row.'.$key.',zone_rows.'.$key.'|required_without_all:zone_capacity.'.$key;
            $rules['start_row.'.$key]       = 'integer|min:1|required_with:zone_columns.'.$key.',zone_rows.'.$key.',start_column.'.$key.'|required_without_all:zone_capacity.'.$key;
            $rules['price.'.$key]           = 'required|numeric|min:0';
        }
        $presentations = $this->request->get('start_date');
        if($presentations)
        foreach($presentations as $key=>$val){
            $rules['start_date.'.$key]  = 'required|date';
            $rules['start_time.'.$key]  = 'required_with:start_date';

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

    public function messages(){
        $messages = array();
        $messages['image.image'] = 'La imagen debe ser del tipo .jpg o .png';
        $zones = $this->request->get('zone_names'); 
        if($zones)
        foreach($zones as $key=>$val)
        {
            $messages['zone_columns.'.$key.'.required_with'] = 'Se deben completar los campos de filas y columnas de la zona '.($key+1);
            $messages['zone_rows.'.$key.'.required_with'] = 'Se deben completar los campos de filas y columnas de la zona '.($key+1);
            $messages['start_column.'.$key.'.required_with'] = 'Se deben completar los campos de filas y columnas de la zona '.($key+1);
            $messages['start_row.'.$key.'.required_with'] = 'Se deben completar los campos de filas y columnas de la zona '.($key+1);
        }
        return $messages;
    }
}