<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Zone;
use App\Models\Presentation;
use App\Models\Slot;
use App\Models\Category;
use App\Models\Organizer;
use App\Models\Local;
use App\Services\FileService;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->file_service = new FileService();
    }

    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexExternal()
    {
        return view('external.events');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_list = Category::all()->lists('name','id');
        $organizers_list = Organizer::all()->lists('name','id');
        $locals_list = Local::all()->lists('name','id');
        $array = ['categories_list' =>$categories_list,
                'organizers_list'   =>$organizers_list,
                'locals_list'       =>$locals_list];
        return view('internal.promoter.newEvent', $array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEvent($data){
        $event = new Event();
        $event->name         = $data['name'];
        $event->description  = $data['description'];
        $event->category_id  = $data['category_id'];
        $event->organizer_id = $data['organizer_id'];
        $event->local_id     = $data['local_id'];
        $event->time_length  = $data['time_length'];
        $event->publication_date = strtotime($data['publication_date']);
        $event->selling_date = strtotime($data['selling_date']);
        $event->image        = 'imagen'; //$this->file_service->upload($data['image'],'event');
        $event->save();
        return $event;
    }

    public function storePresentation($data, $event){
        $function = new Presentation();
        $function->starts_at = strtotime($data['starts_at']);
        $function->cancelled = false;
        $function->sold_out = false;
        $function->event()->associate($event);
        $function->save();
        return $function;
    }

    public function storeZone($data, $event){
        $zone = new Zone();
        $zone->name         = $data['name'];
        $zone->price        = $data['price'];

        if($data['columns'] != '' || $data['columns'] != null){ 
            $zone->columns      = $data['columns'];
            $zone->rows         = $data['rows'];
            $zone->start_column = $data['start_column'];
            $zone->start_row    = $data['start_row'];
            $zone->capacity     = $zone->columns* $zone->rows;
            $zone->slots_availables = $zone->columns* $zone->rows;
        } else {
            $zone->capacity     = $data['capacity'];
            $zone->slots_availables = $data['capacity'];
        }

        $zone->event()->associate($event);
        $zone->save();
        return $zone;
    }

    public function storeRestOfEvent($zone_data, $data, $event){
        $functions_ids = array();
        foreach($data['function_starts_at'] as $key=>$value){
            $function_data = [
                'starts_at' => $value,
            ];
            $function = $this->storePresentation($function_data, $event);
            $functions_ids[$function->id] = ['status' => config('constants.seat_available')];
        }
        foreach($zone_data['zone_names'] as $key=>$value){
            $zone_data2 = [
                'name'      => $value,
                'capacity'  => $zone_data['zone_capacity'][$key],
                'price'     => $zone_data['price'][$key],
                'columns'   => $zone_data['zone_columns'][$key],
                'rows'      => $zone_data['zone_rows'][$key],
                'start_column' => $zone_data['start_column'][$key],
                'start_row'    => $zone_data['start_row'][$key]
            ];
            $zone = $this->storeZone($zone_data2, $event);
            if($zone_data['zone_columns'][$key] != '' || $zone_data['zone_columns'][$key] != null){
                for($i=1; $i <= $zone->rows;$i++){
                    for($j=1; $j <= $zone->columns;$j++){
                        $seat = new Slot();
                        $seat->row = $i;
                        $seat->column = $j;
                        $seat->zone()->associate($zone);
                        $seat->save();
                        $seat->presentation()->attach($functions_ids);
                    }
                }
            }
            else{
                for( $i=1; $i<= ($zone->capacity); $i++) {
                    $seat = new Slot();
                    $seat->zone()->associate($zone);
                    $seat->save();
                    $seat->presentation()->attach($functions_ids);
                }
            }
        }
        
    }

    public function store(StoreEventRequest $request)
    {
        $temp = array_unique($request->input('function_starts_at'));
        if(count($temp) < count($request->input('function_starts_at')))
            //return redirect()->back()->withInput()->withErrors(['errors' => 'No pueden haber dos funciones con la misma fecha/hora de inicio']);
            return response()->json(['message' => 'No pueden haber dos funciones con la misma hora de inicio']);
        $result = $this->capacity_validation($request->only('zone_capacity','start_column', 'start_row', 'zone_columns', 'zone_rows', 'local_id', 'zone_capacity', 'zone_names')); //aca debo validar lo de la capacidad 
        if($result['error'] != '')
            //return redirect()->back()->withInput()->withErrors(['errors' => $result['error']]);
            return response()->json(['message' => $result['error']]);
        die();
        $data = [
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'category_id'   => $request->input('category_id'),
            'organizer_id'  => $request->input('organizer_id'),
            'local_id'      => $request->input('local_id'),
            'publication_date' => $request->input('publication_date'),
            'selling_date'  => $request->input('selling_date'),
            'imagen'        => $request->file('image'),
            'time_length'   => $request->input('time_length')
        ];
        $event = $this->storeEvent($data);
        $zone_data = [
            'zone_names'      => $request->input('zone_names'),
            'zone_capacity'  => $request->input('zone_capacity'),
            'price'     => $request->input('price'),
            'zone_columns'   => $request->input('zone_columns'),
            'zone_rows'      => $request->input('zone_rows'),
            'start_column' => $request->input('start_column'),
            'start_row'    => $request->input('start_row')
        ];
        $data2 = [
            'function_starts_at' => $request->input('function_starts_at')
        ];
        $this->storeRestOfEvent($zone_data, $data2, $event);
        //return redirect()->route('events.edit', $event->id);
        return response()->json(['message' => 'Event added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showExternal($id)
    {
        $user = \Auth::user();

        // $object = Event::findOrFail($id);
        $object = array(
                "id" => $id,
                "name" => "Evento ".$id,
                "important" => False,
                "description" => "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, ",
                "status" => True,
                "date" => "2015-12-12",
                "time" => "foo",
                "image" => "images/piaf.jpg",
                "available" => true,
                "local" => "object"
            );
        return view('external.event', ['event' => (object)$object, 'user'=>$user]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showClientRecord()
    {
        return view('internal.client.record');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPromoterRecord()
    {
        return view('internal.promoter.record');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFunction()
    {
        return view('internal.promoter.addFunction');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deletePresentations($event_id){
        $presentations = Presentation::where('event_id', $event_id)->get();
        foreach ($presentations as $presentation) {
            //Presentation::where
            $presentation->delete();
        }
        
    }

    public function deleteZones($event_id){
        $zones = Zone::where('event_id', $event_id)->get();
        foreach ($zones as $zone) {
            $zone->delete();
        }
        
    }
    public function updateEvent($data, $old_event){
        $old_event->name         = $data['name'];
        $old_event->description  = $data['description'];
        $old_event->category_id  = $data['category_id'];
        $old_event->organizer_id = $data['organizer_id'];
        $old_event->local_id     = $data['local_id'];
        $old_event->time_length  = $data['time_length'];
        $old_event->publication_date = strtotime($data['publication_date']);
        $old_event->selling_date = strtotime($data['selling_date']);
        $image_url = $old_event->image;
        if($data['image'] != null)
            $old_event->image        = 'imagen_updated'; //$this->file_service->upload($data['image'],'event');
        else
            $old_event->image = $image_url;
        $old_event->save();

        return $old_event;
    }
    public function edit($id)
    {
        Event::find($id);
        return view('internal.promoter.editEvent', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function capacity_validation($data){
        $total_capacity = 0;
        $temp = array_unique($data['zone_names']);
        if(count($temp) < count($data['zone_names']))
            return ['error' => 'nombres de zonas repetidos'];
        $temp = array();
        
        $local = Local::find($data['local_id']);
        if($local->rows >=1 && !$data['zone_columns'])
            return ['error' => 'se debe especificar filas y columnas para este local numerado'];
        if($data['zone_columns']){
            for($i = 0; $i < count($data['zone_names']); $i++){
                $temp[$i] = [$data['start_column'][$i], $data['start_row'][$i]];
                for($j = $i -1; $j >=0; $j--){
                    if($temp[$j][0] == $data['start_column'][$i] && $temp[$j][1] == $data['start_row'][$i])
                        return ['error' => 'Hay zonas ubicadas en la misma fila y columna'];
                }
            }
            for ($i = 0; $i < count($data['zone_columns']); $i++) {
                $capacity = $data['zone_columns'][$i]*$data['zone_rows'][$i];
                $total_capacity = $total_capacity + $capacity;
                if($data['start_row'][$i] > $local->rows || $data['start_column'][$i] > $local->columns||
                    $data['start_row'][$i]+$data['zone_rows'][$i] -1> $local->rows || 
                    $data['start_column'][$i] +$data['zone_columns'][$i]-1 > $local->columns)
                    return ['error' => 'se seleccionaron filas o columnas mayor a la capacidad del local'];
            }
        } else {
            for($i= 0; $i < count($data['zone_names']);$i++)
                $total_capacity = $total_capacity + $data['zone_capacity'][$i];
        }
        if($total_capacity > $local->capacity)
            return ['error' => 'la capacidad del evento excede a la del local'];
        $result = [
            'error' => '',
            'total_capacity' => $total_capacity
        ];
        return $result;
    }

    public function calculateEventCapacity($event_id){
        $zones = Zone::where('event_id', $event_id)->get();
        $capacity = 0;
        foreach ($zones as $zone) {
            $capacity = $capacity + $zone->capacity;
        }
        return $capacity;
    }
    public function update(UpdateEventRequest $request, $id)
    {
        $temp = array_unique($request->input('function_starts_at'));
        if(count($temp) < count($request->input('function_starts_at')))
            //return redirect()->back()->withInput()->withErrors(['errors' => 'No pueden haber dos funciones con la misma fecha/hora de inicio']);
            return response()->json(['message' => 'No pueden haber dos funciones con la misma hora de inicio']);
        $result = $this->capacity_validation($request->only('zone_capacity','start_column', 'start_row', 'zone_columns', 'zone_rows', 'local_id', 'zone_capacity', 'zone_names')); //aca debo validar lo de la capacidad 
        if($result['error'] != '')
            //return redirect()->back()->withInput()->withErrors(['errors' => $result['error']]);
            return response()->json(['message' => $result['error']]);
        $event = Event::find($id);
        $actual_local = Local::find($event->local_id);
        $new_local = Local::find($request->input('local_id'));
        $old_capacity = $this->calculateEventCapacity($id);
        $new_capacity = $result['total_capacity'];
        if($event->local_id != $request->input('local_id')){
            if($actual_local->rows >=1 && $request->input('selling_date')<now())
                return redirect()->back()->withInput()->withErrors(['errors' => 'Ya inició la venta del evento. No se puede modificar el local']);
            if($actual_local->rows == null && $request->input('selling_date')<now()){
                if($new_local->rows != null)
                    return redirect()->back()->withInput()->withErrors(['errors' => 'Ya inició la venta del evento. No se puede modificar el local a uno numerado']);
                if($new_local->rows == null && $new_capacity < $old_capacity)
                    return redirect()->back()->withInput()->withErrors(['errors' => 'Ya inició la venta. No se puede cambiar a un local con menor capacidad.']);
                if($new_local->rows == null && $new_capacity >= $old_capacity){
                    //aqui no puedo borrar asi que se debe hacer el update porque ya se empezo a vender
                    $result = $this->updateSellingEvent($request->all(), $id);
                    if($result['error'] != '')
                        return redirect()->back()->withInput()->withErrors(['errors' => $result['error']]);
                    //return redirect()->route('events.edit', $event->id);
                    return response()->json(['message' => 'Event modified']);
                }
            }
        //esto ocurre cuando hay cambio de local pero está antes del selling date
            $data = [
                'name'          => $request->input('name'),
                'description'   => $request->input('description'),
                'category_id'   => $request->input('category_id'),
                'organizer_id'  => $request->input('organizer_id'),
                'local_id'      => $request->input('local_id'),
                'publication_date' => $request->input('publication_date'),
                'selling_date'  => $request->input('selling_date'),
                'time_length'  => $request->input('time_length'),
                'image'        => $request->file('image')
            ];
            $this->deletePresentations($event->id); //NO DEBE BORRAR PRESENTACIONES, SOLO HACERLES UPDATE
            $this->deleteZones($event->id); //TAMPOCO DEBE BORRAR ZONAS, SOLO HACERLES UPDATE
            $updated_event = $this->updateEvent($data, $event);
            $zone_data = [
                'zone_names'      => $request->input('zone_names'),
                'zone_capacity'  => $request->input('zone_capacity'),
                'price'     => $request->input('price'),
                'zone_columns'   => $request->input('zone_columns'),
                'zone_rows'      => $request->input('zone_rows'),
                'start_column' => $request->input('start_column'),
                'start_row'    => $request->input('start_row')
            ];
            $data2 = [
                'function_starts_at' => $request->input('function_starts_at')
            ];
            $this->storeRestOfEvent($zone_data, $data2, $updated_event);
        }
        //si No estamos haciendo un cambio de local, solo se updatea el evento, zona y presentacion, no se tocan los sitios
        //y no se borra nada -_-
        //debo verificar que no se esten cambiando la capacidad o fila/columna de zona si ya se empezó a vender
        //return redirect()->route('events.edit', $event->id);
        return response()->json(['message' => 'Event modified']);
    }

    public function updateSellingEvent($data, $event_id){
        $event = Event::find($event_id);
        $updatedEvent = $this->updateEvent($data, $event);
        $zones = Zone::where('event_id', $event_id)->get();
        $presentations = Presentation::where('event_id', $event_id)->get();
        $count = 0;
        foreach ($zones as $zone) {
            $new_capacity = $data['zone_capacity'][$count];
            $max_sold_slots = //query de buscar max asientos ocupados de esta zona;
            if($new_capacity < $max_sold_slots)
                return ['error' => 'no se puede modificar la zona a una capacidad menor a las entradas vendidas'];
            $zone->name = $data['zone_names'][$count];
            $zone->price = $data['price'][$count];
            $old_capacity = $zone->capacity;
            $zone->capacity = $data['zone_capacity'][$count];
            $zone->save();
            $seats = Slot::where('zone_id', $zone->id)->get();
            foreach ($seats as $seat) {
                foreach ($seat->presentation as $presentation) {
                    if($presentation->pivot->status == config('constants.seat_available'))
                        $seat->presentation()->detach($presentation->id);
                }
            }
            $count++;
        }
        foreach ($presentations as $presentation) {
            $presentation->
        }
        return ['error' => ''];
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
