<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Models\Ticket;
use App\Models\Slot;
use App\Models\Event;
use App\Models\Presentation;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TicketController extends Controller
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
    public function indexReturn()
    {
        return view('internal.admin.ticketReturn');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createReturn()
    {
        return view('internal.admin.newTicketReturn');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createClient($id)
    {
        return view('internal.client.buy');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createSalesman($id)
    {
        //Buscar y enviar info de evento con $id
        $event = Event::find($id);
        $presentations = Presentation::where('event_id', $id)->lists('starts_at','id');
        foreach($presentations as $key => $pres){
            $presentations[$key] = date("Y-m-d", $pres);
        }
        $presentations = $presentations->toArray();
        $zones = Zone::where('event_id', $id)->lists('name','id');
        $slots = DB::table('slot_presentation')->where('presentation_id',$event->presentations[0]->id)->where('status',1)->lists('slot_id','slot_id');
        //$slots = $event->presentations[0]->slots->where('status',1)->lists('id','id');
        return view('internal.salesman.buy',compact('event','presentations','zones','slots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        //Deberia jalar los ids de los asientos del evento pero estoy usando un json por mientras
        //dd($request->all());
        //return back()->withInput($request->except('seats'))->withErrors(['El asiento 1 no esta libre']);
        $seats = $request['seats'];
        
        foreach($seats as $seat_id){
            $slot = DB::table('slot_presentation')
                ->where('slot_id',$seat_id)
                ->where('presentation_id', $request['presentation_id'])
                ->first();
            if($slot->status != config('constants.seat_available')){
                return back()->withInput()->withErrors(['El asiento '. $seat_id.' no esta libre']);
            }
        }
               
        DB::beginTransaction();

        try{
            foreach($seats as $seat_id){

                //Cambiar estado de asiento
                DB::table('slot_presentation')
                    ->where('slot_id', $seat_id)
                    ->where('presentation_id', $request['presentation_id'])
                    ->update(['status' => config('constants.seat_taken')]);
                
                $zone = Zone::find($request['zone_id']);

                //Crear ticket
                if($request['user_id']!=""){
                    DB::table('tickets')->insert(
                    ['payment_date'         => new Carbon(),
                     'reserve'              => 0,
                     'cancelled'            => 0,
                     'owner_id'             => $request['user_id'],
                     'event_id'             => $request['event_id'],
                     'price'                => $zone->price, //Falta reducir el porcentaje de promocion
                     'presentation_id'      => $request['presentation_id'],
                     'seat_id'              => $seat_id
                     ]
                    );
                    
                    //Aumentar puntos de cliente
                    $user = User::find($request['user_id']);
                    DB::table('users')->where('id', $request['user_id'])->update(['points' => $user->points + 1]);

                }else{
                    DB::table('tickets')->insert(
                    ['payment_date'         => new Carbon(),
                     'reserve'              => 0,
                     'cancelled'            => 0,
                     'event_id'             => $request['event_id'],
                     'price'                => $zone->price, //Falta reducir el porcentaje de promocion
                     'presentation_id'      => $request['presentation_id'],
                     'seat_id'              => $seat_id
                     ]
                    );
                }

                //Disminuir disponibles
                $event = Event::find($request['event_id']);
                //DB::table('events')->where('id', $request['event_id'])->update(['available' => $event->available - 1]);

                //var_dump('llego');
            }
            
            //die();
            DB::commit();
        }catch (\Exception $e){
            //var_dump($e);
            //dd('rollback');
            DB::rollback();
        }

        $tickets = array();
        foreach($seats as $seat_id){
            array_push($tickets,Ticket::where('seat_id',$seat_id)->first()->id);
        }

        session(['tickets'=>$tickets]);

        return redirect()->route('ticket.success.salesman');
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
     * @return \Illuminate\Http\Response
     */
    public function showSuccess()
    {
        return view('internal.client.successBuy');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSuccessSalesman()
    {
        $tickets = array();
        $tickets_id = session('tickets');
        foreach ($tickets_id as $ticket_id) {
            array_push($tickets,Ticket::find($ticket_id));
        }
        return view('internal.salesman.successBuy',compact('tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function giveaway()
    {
        return view('internal.salesman.giveaway');
    }

    /**
     * Returns a client if it exists
     * @param  request $request DI of the user
     * @return Object           User::
     */
    public function getClient(request $request)
    {
        $user = User::where('di', $request['id'])->first();
        return $user;
    }

    /**
     * Returns price of given zone
     * @param  request $request Id of zone
     * @return Object           Price
     */
    public function getPrice(request $request)
    {
        $zone = Zone::where('id', $request['id'])->first();
        return $zone;
    }
}
