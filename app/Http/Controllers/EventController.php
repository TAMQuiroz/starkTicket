<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\StoreHighlightRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Requests\Event\CancelEventRequest;
use App\Http\Requests\Presentation\StorePresentationRequest;
use App\Http\Requests\Comment\StoreCommentPostRequest;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Zone;
use App\Models\Presentation;
use App\Models\Slot;
use App\Models\Category;
use App\Models\Highlight;
use App\Models\Organizer;
use App\Models\Local;
use App\Models\Comment;
use App\Models\CancelEvent;
use App\Models\CancelPresentation;
use App\Services\FileService;
use Carbon\Carbon;
use App\User;
use Auth;
use Session;
use DB;
use File;

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
    public function indexExternal(Request $request)
    {
        var_dump($request['title']);
        $nombres = explode(" ",$request['title']);
        $events = Event::where("cancelled","=","0")->where('publication_date','<',strtotime(Carbon::now()));
        foreach ($nombres as $nombre) {

            if($nombre!='')
                $events = $events->where('name','like','%'.$nombre.'%');
            # code...
        }
        $events = $events->get();
        $auxEvent = [];
        foreach ($events as $event) {
             if (count($event->presentations)>0)
                array_push($auxEvent,$event);
         }
         $events = $auxEvent;

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
        if(count($locals_list) == 0){
            return back()->withErrors(['No se tienen locales para crear eventos']);
        }
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
        $event->promoter_id  = Auth::user()->id;
        $event->image        = $this->file_service->upload($data['image'],'event');
        if($data['distribution_image'])
            $event->distribution_image = $this->file_service->upload($data['distribution_image'],'event');
        if($data['percentage_comission']!='')
            $event->percentage_comission = $data['percentage_comission'];
        if($data['amount_comission']!='')
            $event->amount_comission = $data['amount_comission'];
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

    public function feedback(){

     return view('internal.client.event_feedback' );
 }



 public function attendanceDetail()
 {

     return view('internal.admin.attendanceDetail '  );

        //return $datePar ;
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
        $sitios_zona = $zone_data['seats_ids'][$key];
        if($zone_data['zone_columns'][$key] != '' || $zone_data['zone_columns'][$key] != null){
            foreach ($sitios_zona as $key => $value) {
                $fil_cols = explode("_", $value);
                $slot = new Slot();
                $slot->row = $fil_cols[0];
                $slot->column = $fil_cols[1];
                $slot->zone_id = $zone->id;
                $slot->save();
                $slot->presentation()->attach($functions_ids);
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

public function validateFreeLocal($starts_at, $local_id, $time_length){
    $events = Event::where('local_id', $local_id)->get();
    if($events->count()>0){
        foreach ($starts_at as $start_at) {
            $min_date = strtotime($start_at);
            $max_date = $min_date + ($time_length*3600);
            foreach ($events as $event) {
                $presentations = $event->presentations;
                foreach ($presentations as $presentation) {
                    $date = intval($presentation->starts_at);
                    $end_date = $date + (3600*$event->time_length);
                    if(($date<=$max_date && $date>=$min_date)|| ($end_date<=$max_date && $end_date>=$min_date))
                        return ['error' => 'Este local tiene programadas presentaciones en las fechas y horas especificadas'];

                }
            }
        }
    }
    else return null;
}

public function seCruzanFunciones(array $presentations_time, $duracion){
    foreach ($presentations_time as $key => $value) {
        for($i=0;$i<count($presentations_time);$i++){
            if($i!= $key){
                $start = strtotime($presentations_time[$i]);
                $end = $start+($duracion*3600);
                if(strtotime($value)<=$end && strtotime($value) >=$start){
                    return true;
                }
            }
        }
    }
    return false;
}

public function store(StoreEventRequest $request)
{

    $result_dates = $this->join_date_time($request->input('start_time'),$request->input('start_date'));
    $result_local_validation = $this->validateFreeLocal($result_dates, $request->input('local_id'), $request->input('time_length'));
    if($result_local_validation != null){
        return redirect()->back()->withInput()->withErrors($result_local_validation);
    }
    $temp = array_unique($result_dates);
    if(count($temp) < count($result_dates))
        return redirect()->back()->withInput()->withErrors(['errors' => 'No pueden haber dos funciones con la misma fecha/hora de inicio']);
            //return response()->json(['message' => 'No pueden haber dos funciones con la misma hora de inicio']);

    if($this->seCruzanFunciones($result_dates, $request->input('time_length')))
        return redirect()->back()->withInput()->withErrors(['errors' => 'Verificar presentaciones. Algunas horas y fechas se cruzan']);
    $result = $this->capacity_validation($request->only('zone_capacity','start_column', 'start_row', 'zone_columns', 'zone_rows', 'local_id', 'zone_capacity', 'zone_names')); //aca debo validar lo de la capacidad
    if($result['error'] != '')
        return redirect()->back()->withInput()->withErrors(['errors' => $result['error']]);
            //return response()->json(['message' => $result['error']]);

    $data = [
    'name'           => $request->input('name'),
    'description'    => $request->input('description'),
    'category_id'    => $request->input('category_id'),
    'organizer_id'   => $request->input('organizer_id'),
    'local_id'       => $request->input('local_id'),
    'time_length'    => $request->input('time_length'),
    'selling_date'   => $request->input('selling_date'),
    'image'          => $request->file('image'),
    'distribution_image'   => $request->file('distribution_image'),
    'publication_date'     => $request->input('publication_date'),
    'percentage_comission' => $request->input('percentage_comission',''),
    'amount_comission'     => $request->input('amount_comission',''),
    ];
    $event = $this->storeEvent($data);
    $seats_ids = $request->input('seats_ids');

    $zone_data = [
    'zone_names'     => $request->input('zone_names'),
    'zone_capacity'  => $request->input('zone_capacity'),
    'price'          => $request->input('price'),
    'zone_columns'   => $request->input('zone_columns'),
    'zone_rows'      => $request->input('zone_rows'),
    'start_column'   => $request->input('start_column'),
    'start_row'      => $request->input('start_row'),
    'seats_ids'          => $request->input('seats_ids'),
    ];
    $data2 = [
            //'start_date'    => $request->input('start_date'),
            //'start_time'    => $request->input('start_time'),
    'function_starts_at' => $result_dates
    ];
    $this->storeRestOfEvent($zone_data, $data2, $event);
    return redirect()->route('promoter.record');
        //return redirect()->route('events.edit', $event->id);
        //return response()->json(['message' => 'Event added']);
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('internal.promoter.event.show',["event"=>$event]);
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
        $event = Event::find($id);
        $Comments = Comment::where('event_id',$id  ) ->get();

        if(empty($event)||$event->cancelled)
            return redirect()->back();

       return view('external.event', ['event' => $event, 'user'=>$user ,  'Comments'=> $Comments]);
    }

    public function showExternalPost(StoreCommentPostRequest $request , $id)
    {

        $user = \Auth::user();
        $event = Event::findOrFail($id);
        $input = $request->all();

        //Agrego el nuevo comentario
        $Comment = new Comment ;
        $Comment->description   =   $input['comment'];
        $Comment->time          =   new Carbon();
        $Comment->event_id      = $id;
        $Comment->user_id       = Auth::user()->id;
        $Comment->save();

        Session::flash('message', 'Comentario publicado');
        Session::flash('alert-class','alert-success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showClientRecord()
    {
        $userId = Auth::user()->id;
        $tickets = Ticket::where("owner_id",$userId)->paginate(10);
        return view('internal.client.record',["tickets"=>$tickets]);
    }
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPromoterRecord()
    {
        $events = Event::where('promoter_id',Auth::user()->id)->paginate(5);
        $event_data = [];
        foreach ($events as $event) {
            $ticket_sum = Ticket::where('event_id',$event->id)->sum('total_price');
            $ticket_quantity = Ticket::where('event_id',$event->id)->sum('quantity');
            $event->ticket_sum = $ticket_sum;
            $event->ticket_quantity = $ticket_quantity;
        }
        return view('internal.promoter.event.record',array('events' => $events));
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
        $dist_url = $old_event->distribution_image;
        if($data['image'] != null)
            $old_event->image        = $this->file_service->upload($data['image'],'event');
        else
            $old_event->image = $image_url;
        if($data['distribution_image'] != null)
            $old_event->distribution_image = $this->file_service->upload($data['distribution_image'],'event');
        else
            $old_event->distribution_image = $dist_url;
        $old_event->save();
        return $old_event;
    }
    public function edit($id)
    {
        $event = Event::find($id);
        $categories_list = Category::where('type',1)->lists('name','id');
        $organizers_list = Organizer::all()->lists('businessName','id');

        $locals_list = Local::all()->lists('name','id');
        $capacity_list = Local::all();
        $array = [
        'event'             =>$event,
        'categories_list'   =>$categories_list,
        'organizers_list'   =>$organizers_list,
        'locals_list'       =>$locals_list,
        'capacity_list'     =>$capacity_list];
        return view('internal.promoter.editEvent', $array);
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
        if($data['zone_columns']){ // esta entrando a pesar de no ser numerado el local :S :S
         $seats_ids = array();
         /*
         for($i = 0; $i < count($data['zone_names']); $i++){
             for($j = $data['start_column'][$i]; $j<= $data['start_column'][$i] + $data['zone_columns'][$i]-1;$j++)
                for($k= $data['start_row'][$i]; $k<=$data['start_row'][$i] + $data['zone_rows'][$i]-1;$k++){
                    $id = ''.$k.'_'.$j;
                    if(in_array($id, $seats_ids)){
                        return ['error' => 'Hay zonas con asientos cruzados. Por favor configurar bien las zonas'];
                    }
                    array_push($seats_ids, $id);
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
         */
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

    $result_dates = $this->join_date_time($request->input('start_time'),$request->input('start_date'));
    $now = new DateTime();
    $temp = array_unique($result_dates);
    if(count($temp) < count($result_dates))
        return redirect()->back()->withInput()->withErrors(['errors' => 'No pueden haber dos funciones con la misma fecha/hora de inicio']);
            //return response()->json(['message' => 'No pueden haber dos funciones con la misma hora de inicio']);
        $result = $this->capacity_validation($request->only('zone_capacity','start_column', 'start_row', 'zone_columns', 'zone_rows', 'local_id', 'zone_capacity', 'zone_names')); //aca debo validar lo de la capacidad
        if($result['error'] != '')
            return redirect()->back()->withInput()->withErrors(['errors' => $result['error']]);
            //return response()->json(['message' => $result['error']]);

        $event = Event::find($id);
        $actual_local = Local::find($event->local_id);
        $new_local = Local::find($request->input('local_id'));
        $old_capacity = $this->calculateEventCapacity($id);
        $new_capacity = $result['total_capacity'];
        if($event->local_id != $request->input('local_id')){
            if($actual_local->rows >=1 && strtotime($request->input('selling_date'))<$now->getTimestamp()){
                return redirect()->back()->withInput()->withErrors(['errors' => 'Ya inició la venta del evento. No se puede modificar el local']);
            }
            if($actual_local->rows == null && strtotime($request->input('selling_date'))<$now->getTimestamp()){
                if($new_local->rows != null)
                    return redirect()->back()->withInput()->withErrors(['errors' => 'Ya inició la venta del evento. No se puede modificar el local a uno numerado']);
                if($new_local->rows == null && $new_capacity < $old_capacity)
                    return redirect()->back()->withInput()->withErrors(['errors' => 'Ya inició la venta. No se puede cambiar a un local con menor capacidad.']);
                if($new_local->rows == null && $new_capacity >= $old_capacity){
                    //aqui no puedo borrar asi que se debe hacer el update porque ya se empezo a vender
                    $result = $this->updateSellingEvent($request->all(), $id);
                    if($result['error'] != '')
                        return redirect()->back()->withInput()->withErrors(['errors' => $result['error']]);
                }
            }
        //esto ocurre cuando hay cambio de local pero está antes del selling date

        }
        //verificar que no se esten cambiando la capacidad o fila/columna de zona si ya se empezó a vender
        if($now->getTimestamp() > strtotime($request->input('selling_date'))){
            $zones = Zone::where('event_id', $id)->get();
            $i = 0;
            if($zones->count() != count($request->input('zone_names')))
                return redirect()->back()->withErrors(['Venta de evento iniciada. No se puede alterar la cantidad de zonas.']);
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
        'time_length'   => $request->input('time_length'),
        'image'         => $request->file('image'),
        'distribution_image' => $request->file('distribution_image'),
        'percentage_comission' => $request->input('percentage_comission',''),
        'amount_comission'     => $request->input('amount_comission',''),
        ];
        if($now->getTimestamp() < strtotime($request->input('selling_date'))){
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
            //'start_date'    => $request->input('start_date'),
            'function_starts_at' => $result_dates
            ];
            $this->storeRestOfEvent($zone_data, $data2, $updated_event);

        } else{
            //despues del selling date pero sin cambio de local, se puede agregar zonas pero no funciones
            $updated_event = $this->updateEvent($data, $event);
            //para presentaciones, solo se agregan o se cambian con fecha pasadas la fecha actual
            $presentations = Presentation::where('event_id', $id)->get();
            $i = 0;
            foreach($presentations as $key=>$presentation){
                if($now->getTimestamp() < $presentation->starts_at){
                    $presentation->starts_at = strtotime($result_dates[$key]);
                    $presentation->save();
                } else{
                    if($presentation->starts_at != $result_dates[$key])
                        return redirect()->back()->withInput()->withErrors(['errors' => 'No se puede modificar una presentación con fecha pasada']);
                }
            }
            if($presentations->count() < count($result_dates)){
                for($i = $presentations->count() ; $i<count($result_dates); $i++){
                    $data = ['starts_at' => $result_dates[$i]];
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
        return redirect()->route('promoter.record');
        //return response()->json(['message' => 'Event modified']);
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
        $event = Event::find($id);
        if(is_null($event))
            return redirect()->back()->withErrors(['error' => 'Seleccione un evento válido']);
        //verificar que el evento ya terminó completamente o está antes del publication date
        if($event->publication_date < time()){
            if(!$event->presentations->isEmpty())
                if($event->presentations->last()->starts_at > time())
                    return redirect()->back()->withErrors(['error' => 'No se puede eliminar este evento ya que aun tiene presentaciones vigentes']);
        }
        $this->deletePresentations($id);
        $this->deleteZones($id);
        File::delete($event->image);
        if($event->distribution_image != null)
            File::delete($event->distribution_image);
        $event->delete();
        return redirect()->route('promoter.record');
    }

    public function destroyComment($idComment)
    {
        $comment = Comment::find($idComment);
        $comment->delete();

        return redirect()->back();
    }


    public function subcategoriesToAjax($id)
    {
        $subcategories = Category::where('father_id',$id)->lists('name','id');
        return json_encode($subcategories);
    }

    public function getLocal($id)
    {
        $local = Local::find($id);
        return $local;
    }
    public function cancel($id)
    {
        $event = Event::findOrFail($id);


        if($event->cancelled)
        {
            Session::flash('message', 'El evento ya fue cancelado');
            Session::flash('alert-class','alert-warning');
            return redirect('/promoter/event/record');
        }
        return view('internal.promoter.event.cancel', array('event'=>$event));
    }
    public function cancelStorage(StorePresentationRequest $request, $event_id)
    {

        $event = Event::findOrFail($event_id);
        $presentations = $event->presentations;

        $user_id = Auth::user()->id;

        $input = $request->all();

        foreach ($presentations as $presentation)
        {
            $presentation->cancelled = "1";
            $presentation->save();

            $cancel = new CancelPresentation;
            $cancel->presentation_id = $presentation->id;
            $cancel->user_id = $user_id;
            $cancel->reason = $input['reason'];
            $cancel->duration = $input['duration'];
            $cancel->authorized = $input['authorized'];
            $cancel->date_refund = $input['date_refund'];
            $cancel->save();
        }
        $event->cancelled = 1;
        $event->save();

        Session::flash('message', 'Evento cancelado!');
        Session::flash('alert-class','alert-success');
        return redirect('promoter/event/record');
    }
    public function getHighlights(){
        //$destacados = Highlight::where('active','1')->orWhere('start_date','>',Carbon::now())->with('event')->get();
        $destacados = Highlight::all();
        return view('internal.promoter.highlights.index', array('destacados'=>$destacados));
    }

    public function createHighlight(){
        $activos = Highlight::where('active','1')->orderBy('start_date','desc')->get();
        $min_date = Carbon::now();
        if($activos->count()<config('constants.maxDestacados')){
            $min_date = Carbon::now()->addDay();
        }
        else{
            $no_activos = Highlight::where('active','0')->where('start_date', '>', Carbon::now())->get();
            if($no_activos < config('constants.maxDestacados')){
                $ultimo_activo = $activos->first();
                $min_date = $ultimo_activo->start_date->addDays($ultimo_activo->days_active+1);
            } else{
                foreach ($no_activos as $no_activo) {
                    $fecha = $no_activo->start_date->addDays($no_activo->days_active +1);
                    if($fecha<$min_date || $min_date==null)
                        $min_date = $fecha;
                }
            }
        }
        $destacados = Highlight::lists('event_id');
        $eventos = Event::where('cancelled','0')
        ->with(['presentations' => function($query){
            $query->where('starts_at', '<', time())
            ->where('cancelled','0');
        }])->whereNotIn('id', $destacados)->get();
        return view('internal.promoter.highlights.create', array('fecha_min_init' => Carbon::today()->addDay(), 'fecha_min' => Carbon::today(), 'events' => $eventos));
    }

    public function storeHighlight(StoreHighlightRequest $request){
        $fecha = strtotime($request->input('start_date'));
        $fecha_fin = $fecha + ($request->input('days')*3600*24);
        $eventos = Highlight::where('active','1')->orWhere('start_date','>',Carbon::now())->get();
        $dias = array();
        foreach ($eventos as $evento) {
            $inicio = strtotime($evento->start_date);
            $fin = $inicio + ($evento->days_active*24*3600);
            if(($inicio<=$fecha_fin && $inicio>=$fecha)||($fin<=$fecha_fin && $fin>=$fecha))
                array_push($dias, ['ini' => $inicio, 'fin' => $fin]);
        }
        for($i = $fecha; $i<= $fecha_fin; $i=$i+(3600*24)){
            $count = 0;
            foreach ($dias as $key => $value) {
                if($i >= $value['ini'] && $i <=$value['fin']) $count++;
            }
            if($count > config('constants.maxDestacados')-1)
                return redirect()->back()->withErrors(['error'=> 'Ya hay un evento programado para el rango de fechas seleccionado']);
        }
        $highlight = new Highlight;
        $highlight->days_active = $request->input('days');
        $highlight->start_date = $request->input('start_date');
        $highlight->active = false;
        $event = Event::find($request->input('event_id'));
        $highlight->event()->associate($event);
        $highlight->save();
        return redirect()->route('promoter.highlights.index');
    }

    public function editDate($id, Request $request){
        Highlight::where('id', $id)->update(['start_date' => $request['start_date']]);

        return redirect()->route('promoter.highlights.index');
    }
}
