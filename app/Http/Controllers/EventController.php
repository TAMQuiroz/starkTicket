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
use DateTime;
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
        $events = Event::all();
        return view('external.events',compact('events'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_list = Category::where('type',1)->lists('name','id');
        $organizers_list = Organizer::all()->lists('businessName','id');

        $locals_list = Local::all()->lists('name','id');
        $capacity_list = Local::all();
        $array = ['categories_list' =>$categories_list,
                'organizers_list'   =>$organizers_list,
                'locals_list'       =>$locals_list,
                'capacity_list'     =>$capacity_list];
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
        } else {
            $zone->capacity     = $data['capacity'];
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
                $functions_ids_zones = array();
                foreach ($functions_ids as $key => $value) {
                    $functions_ids_zones[$key] = ['slots_availables' => $zone->capacity];
                }
                $zone->presentation()->attach($functions_ids_zones);
            }
        }
    }

    public function join_date_time($times, $dates){
        $function_starts_at = array();
        foreach ($dates as $key=>$value) {
            $function_starts_at[$key] = $value.' '.$times[$key];
        }
        return $function_starts_at;
    }

    public function store(StoreEventRequest $request)
    {

        $result_dates = $this->join_date_time($request->input('start_time'),$request->input('start_date'));
        $temp = array_unique($result_dates);
        if(count($temp) < count($result_dates))
            return redirect()->back()->withInput()->withErrors(['errors' => 'No pueden haber dos funciones con la misma fecha/hora de inicio']);
            //return response()->json(['message' => 'No pueden haber dos funciones con la misma hora de inicio']);
        $result = $this->capacity_validation($request->only('zone_capacity','start_column', 'start_row', 'zone_columns', 'zone_rows', 'local_id', 'zone_capacity', 'zone_names')); //aca debo validar lo de la capacidad
        if($result['error'] != '')
            return redirect()->back()->withInput()->withErrors(['errors' => $result['error']]);
            //return response()->json(['message' => $result['error']]);
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
            //'start_date'    => $request->input('start_date'),
            //'start_time'    => $request->input('start_time'),
            'function_starts_at' => $result_dates
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

        $event = Event::findOrFail($id);

        return view('external.event', ['event' => $event, 'user'=>$user]);
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
        $objs = Event::all();

        return view('internal.promoter.record',["events"=>$objs]);
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
        $event = Event::find($id);
        return view('internal.promoter.editEvent', ['events' => $event]);
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

        $now = new DateTime();
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
            if($actual_local->rows >=1 && $request->input('selling_date')<$now->getTimestamp())
                return redirect()->back()->withInput()->withErrors(['errors' => 'Ya inició la venta del evento. No se puede modificar el local']);
            if($actual_local->rows == null && $request->input('selling_date')<$now->getTimestamp()){
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

        }
        //verificar que no se esten cambiando la capacidad o fila/columna de zona si ya se empezó a vender
        if($now->getTimestamp() > $request->input('selling_date')){
            $zones = Zone::where('event_id', $id)->get();
            $i = 0;
            foreach($zones as $zone){
                if($zone->capacity != $request->input('zone_capacity.'.$i)||
                $zone->start_row != $request->input('start_row.'.$i)||
                $zone->start_column != $request->input('start_column.'.$i)||
                $zone->columns != $request->input('zone_columns.'.$i)||
                $zone->rows != $request->input('zone_rows.'.$i))
                    return redirect()->back()->withInput()->withErrors(['errors' => 'Venta de evento iniciada. No se puede modificar la capacidad']);
                $i++;
            }
        }
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
        if($now->getTimestamp() < $request->input('selling_date')){
            //antes del sellingdate en general
            $this->deletePresentations($event->id);
            $this->deleteZones($event->id);
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

        } else{
            //despues del selling date pero sin cambio de local, se puede agregar zonas pero no funciones
            $updated_event = $this->updateEvent($data, $event);
            //para presentaciones, solo se agregan o se cambian con fecha pasadas la fecha actual
            $presentations = Presentation::where('event_id', $id)->get();
            $i = 0;
            foreach($presentations as $presentation){
                if($now->getTimestamp() < $presentation->starts_at){
                    $presentation->starts_at = strtotime($request->input('function_starts_at.'.$i));
                    $presentation->save();
                }
            }
            if($presentations->count() < count($request->input('function_starts_at'))){
                for($i = $presentations->count() ; $i<count($request->input('function_starts_at')); $i++){
                    $data = ['starts_at' => $request->input('function_starts_at.'.$i)];
                    $this->storePresentation($data, $event);
                }
            }
            //para zonas, se puede cambiar nombre nada más :v
            $zones = Zone::where('event_id', $id)->get();
            $i = 0;
            foreach($zones as $zone){
                $zone->name = $request->input('zone_names.'.$i);
                $zone->save();
                $i++;
            }
        }
        //si no estamos haciendo un cambio de local, solo se updatea el evento, zona y presentacion
        //return redirect()->route('events.edit', $event->id);
        return response()->json(['message' => 'Event modified']);
    }
    public function updateSellingEvent($data, $event_id){
        //no se considera el cancelar
        //si ya se esta vendiendo, puede modificar la hora de la funcion? ahorita esta que si pero solo para agregar o cambiar funciones posteriores al selling date
        $event = Event::find($event_id);
        $updatedEvent = $this->updateEvent($data, $event);
        $presentations = Presentation::where('event_id', $event_id)->get();
        $functions_ids = array();
        foreach ($presentations as $presentation) {
            $presentation->starts_at = $data['starts_at'];
            $functions_ids[$presentation->id] = ['status' => config('constants.seat_available')];
        }
        $zones = Zone::where('event_id', $event_id)->get();
        $count = 0;
        foreach ($zones as $zone) {
            $new_capacity = $data['zone_capacity'][$count];
            $result = $this->getMaxOccupiedSlots($event_id, $zone->id);//query de buscar max asientos ocupados de esta zona;
            $max_sold_slots = $result['max'];
            $sold = $result['all_sold'];
            if($new_capacity < $max_sold_slots)
                return ['error' => 'no se puede modificar la zona a una capacidad menor a las entradas vendidas'];
            $zone->name = $data['zone_names'][$count];
            $zone->price = $data['price'][$count];
            $old_capacity = $zone->capacity;
            $zone->capacity = $data['zone_capacity'][$count];
            $functions_ids_zones = array();
            $i=0;
            foreach ($functions_ids as $key => $value) {
                $functions_ids_zones[$key] = ['slots_availables' => abs($new_capacity-$sold[$i])];
                $i++;
            }
            $zone->presentation()->sync($functions_ids_zones);
            $zone->save();
            $count++;
        }
        return ['error' => ''];
    }

    public function getMaxOccupiedSlots($event_id, $zone_id){
        $zone = Zone::find($zone_id);
        $all_sold = array();
        $presentations = Presentation::where('event_id', $event_id)->get();
        $max = 0;
        
        foreach($zone->presentations as $presentation){
            $count = 0;
            $availables = $presentation->pivot->slots_availables;
            $count = $zone->capacity - $availables;
            array_push($all_sold, $count);
            if($count > $max) $max = $count;
        }

        $result = ['max' => $max, 'all_sold' => $all_sold];
        return $result;
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
    public function subcategoriesToAjax($id)
    {
        $subcategories = Category::where('father_id',$id)->lists('name','id');
        return json_encode($subcategories);
    }
}
