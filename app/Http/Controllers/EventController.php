<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Zone;
use App\Models\Presentation;
use App\Models\Slot;
use App\Models\Category;
use App\Models\Organizer;
use App\Models\Local;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $categories_list = Category::all()->lists('name','id');
        $organizers_list = Organizer::all()->lists('name','id');
        $locals_list = Local::all()->lists('name','id');
        return view('internal.promoter.newEvent');
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
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->category_id = $request->input('category_id');
        $event->organizer_id = $request->input('organizer_id');
        $event->local_id = $request->input('local_id');
        //$event->image = $this->file_service->upload($request->file('image'),'event');
        $event->save();

        $functions_ids = array();
        foreach($request->input('function_starts_at') as $key=>$value){
            $function = new Presentation();
            $function->starts_at = strtotime($value);
            $function->ends_at = strtotime($request->input('function_ends_at.'.$key));
            $function->sold_out = false;
            $function->cancelled = false;
            $function->event()->associate($event);
            $function->save();
            $functions_ids[$function->id] = ['status' => config('constants.seat_available')];
        }
        foreach($request->input('zone_names') as $key=>$value){
            $zone = new Zone();
            $zone->name = $value;
            $zone->capacity = $request->input('zone_capacity.'.$key);
            $zone->price = $request->input('price.'.$key);
            $zone->event()->associate($event);
            if($request->input('zone_columns.'.$key, '') != ''){
                $zone->columns = $request->input('zone_columns.'.$key);
                $zone->rows = $request->input('zone_rows.'.$key);
                $zone->start_column = $request->input('start_column.'.$key);
                $zone->start_row = $request->input('start_row.'.$key);
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
        return view('internal.promoter.editEvent');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
