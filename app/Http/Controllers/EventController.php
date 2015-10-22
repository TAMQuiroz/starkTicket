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
    public function store(StoreEventRequest $request)
    {
        $event = new Event();
        $event->name         = $request->input('name');
        $event->description  = $request->input('description');
        $event->category_id  = $request->input('category_id');
        $event->organizer_id = $request->input('organizer_id');
        $event->local_id     = $request->input('local_id');
        $event->publication_date = strtotime($request->input('publication_date'));
        $event->selling_date = strtotime($request->input('selling_date'));
        $event->image        = $this->file_service->upload($request->file('image'),'event');
        $event->save();

        $functions_ids = array();
        foreach($request->input('function_starts_at') as $key=>$value){
            $function = new Presentation();
            $function->starts_at = strtotime($value);
            $function->ends_at   = strtotime($request->input('function_ends_at.'.$key));
            $function->cancelled = false;
            $function->slots_availables = $request->input('zone_capacity.'.$key);
            $function->event()->associate($event);
            $function->save();
            $functions_ids[$function->id] = ['status' => config('constants.seat_available')];
        }
        foreach($request->input('zone_names') as $key=>$value){
            $zone = new Zone();
            $zone->name         = $value;
            $zone->capacity     = $request->input('zone_capacity.'.$key);
            $zone->price        = $request->input('price.'.$key);
            $zone->event()->associate($event);

            if($request->input('zone_columns.'.$key, '') != ''){ 
                $zone->columns      = $request->input('zone_columns.'.$key);
                $zone->rows         = $request->input('zone_rows.'.$key);
                $zone->start_column = $request->input('start_column.'.$key);
                $zone->start_row    = $request->input('start_row.'.$key);
                $zone->save();
                foreach($zone->rows as $row){
                    foreach($zone->columns as $column){
                        $seat = new Slot();
                        $seat->row = $row;
                        $seat->column = $column;
                        $seat->zone()->associate($zone);
                        $seat->save();
                        $seat->presentation()->attach($functions_ids);
                    }
                }
            }
            else{
                $zone->save();
                for( $i=1; $i<= ($zone->capacity); $i++) {
                    $seat = new Slot();
                    $seat->zone()->associate($zone);
                    $seat->save();
                    $seat->presentation()->attach($functions_ids);
                }
            }
        }
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
    public function update(UpdateEventRequest $request, $id)
    {
        $event = Event::find($id);
        $event->name         = $request->input('name');
        $event->description  = $request->input('description');
        $event->category_id  = $request->input('category_id');
        $event->organizer_id = $request->input('organizer_id');
        $event->publication_date = strtotime($request->input('publication_date'));
        $event->selling_date = strtotime($request->input('selling_date'));
        $local = Local::find($event->local_id);
        if($local->rows == null && now()<$event->publication_date)
            $event->local_id     = $request->input('local_id');
        if($request->file('image') != null)
            $event->image        = $this->file_service->upload($request->file('image'),'event');
        $event->save();
        $presentations = $request->input('function_starts_at');
        foreach ($presentations as $key => $value) {
            $function = Presentation::find($key);
            $function->starts_at = strtotime($value);
            $function->ends_at   = strtotime($request->input('function_ends_at.'.$key));
            $function->cancelled = $request->input('cancelled');
            $function->save();
        }
//se puede cambiar el local en cualquier momento si es que no es numerado/con asiento
        //no se deberia cambiar el local si es con asientos hasta el selling date
        foreach($request->input('zone_names') as $key=>$value){
            $zone = Zone::find($key);
            $zone->name         = $value;
            if(now()<$event->publication_date)
                $zone->price        = $request->input('price.'.$key);

            if($local->rows >=1 && now()<$event->selling_date){
                if($request->input('zone_columns.'.$key, '') != ''){ 
                    $zone->columns      = $request->input('zone_columns.'.$key);
                    $zone->rows         = $request->input('zone_rows.'.$key);
                    $zone->start_column = $request->input('start_column.'.$key);
                    $zone->start_row    = $request->input('start_row.'.$key);
                    $zone->save();
                    //aca debo borrar todos los asientos y dettach de function_slot
                    Slot::where('zone_id', $zone->id)->delete();
                    foreach($zone->rows as $row){
                        foreach($zone->columns as $column){
                            $seat = new Slot();
                            $seat->row = $row;
                            $seat->column = $column;
                            $seat->zone()->associate($zone);
                            $seat->save();
                            $seat->presentation()->attach($functions_ids);
                        }
                    }
                }
            }
            else if($local->rows == null){
                //puedo cambiar en cualquier momento TT__TT
                //no puedo borrar todos, solo agregar más
                //debo verificar que la capacidad sea mayor a la actual :c
                $zone->save();
                for( $i=$zone->capacity +1; $i<= ($request->input('zone_capacity.'.$key)); $i++) {
                    $seat = new Slot();
                    $seat->zone()->associate($zone);
                    $seat->save();
                    $seat->presentation()->attach($functions_ids);
                }
            }
            $zone->capacity     = $request->input('zone_capacity.'.$key);
            $zone->save();
        }
        //cambiar nombre de zona y precio
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
