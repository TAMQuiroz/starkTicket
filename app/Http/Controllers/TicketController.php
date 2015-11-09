<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Models\Ticket;
use App\Models\Slot;
use App\Models\Event;
use App\Models\Presentation;
use App\Models\Promotions;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests\Giveaway\StoreGiveawayRequest;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createClient($id)
    {
        //Buscar y enviar info de evento con $id
        $event = Event::find($id);
        $presentations = Presentation::where('event_id', $id)->get();

        $slots_array = array();
        foreach ($presentations as $pres) {
            $slots = DB::table('slot_presentation')->where('presentation_id',$pres->id)->where('status',config('constants.seat_available'))->lists('slot_id','slot_id');
            $slots_array[$pres->id] = $slots;
        }

        $presentations = $presentations->lists('starts_at','id');
        foreach($presentations as $key => $pres){
            $presentations[$key] = date("Y-m-d H:i", $pres);
        }
        $presentations = $presentations->toArray();
        $zones = Zone::where('event_id', $id)->lists('name','id');

        return view('internal.client.buy', compact('event','presentations','zones','slots_array'));
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
        $presentations = Presentation::where('event_id', $id)->get();

        $slots_array = array();
        foreach ($presentations as $pres) {
            $slots = DB::table('slot_presentation')->where('presentation_id',$pres->id)->where('status',config('constants.seat_available'))->lists('slot_id','slot_id');
            $slots_array[$pres->id] = $slots;
        }

        $presentations = $presentations->lists('starts_at','id');
        foreach($presentations as $key => $pres){
            $presentations[$key] = date("Y-m-d H:i", $pres);
        }
        $presentations = $presentations->toArray();
        $zones = Zone::where('event_id', $id)->lists('name','id');

        return view('internal.salesman.buy',compact('event','presentations','zones','slots_array'));
    }

    public function getSelectedSlots($seats, $zone_id)
    {
        $seats = json_decode($seats);
        foreach ($seats as $key => $seat){
            $seats[$key] = explode("_",$seat);
            $seats[$key] = Slot::where('column',$seats[$key][1])->where('row',$seats[$key][0])->where('zone_id',$zone_id)->first()->id;
        }

        return $seats;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        //var_dump($request->all());
        $event = Event::find($request['event_id']);
        $zone = Zone::find($request['zone_id']);
        $nTickets = $request['quantity'];

        if ($event->place->rows != null){ //Es numerado
            $seats = $request['seats'];

            $seats = $this->getSelectedSlots($seats, $zone->id);

            foreach($seats as $seat_id){

                $slot = DB::table('slot_presentation')->where('slot_id',$seat_id)->where('presentation_id', $request['presentation_id'])->first();

                if($slot->status != config('constants.seat_available')){
                    return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
                }
            }

        }else{ //No es numerado
            $zoneXpres = DB::table('zone_presentation')->where('zone_id',$request['zone_id'])->where('presentation_id', $request['presentation_id'])->first();
            if($zoneXpres->slots_availables - $nTickets < 0) //Deberia ser zona x presentacion
                return back()->withInput($request->except('seats'))->withErrors(['La zona esta llena']);
        }


        DB::beginTransaction();

        try{
            $tickets = array();
            $sale_id = Ticket::max('sale_id');
            for($i = 0; $i < $nTickets; $i++){


                if ($event->place->rows != null){
                    //Cambiar estado de asiento
                    DB::table('slot_presentation')
                        ->where('slot_id', $seats[$i])
                        ->where('presentation_id', $request['presentation_id'])
                        ->update(['status' => config('constants.seat_taken')]);
                }else{
                    //Disminuir capacidad en la zona de esa presentacion
                    DB::table('zone_presentation')->where('zone_id', $request['zone_id'])
                                                  ->where('presentation_id',$request['presentation_id'])
                                                  ->decrement('slots_availables');;
                }

                //Crear ticket
                $id = DB::table('tickets')->insertGetId(
                ['payment_date'         => new Carbon(),
                 'reserve'              => 0,
                 'cancelled'            => 0,
                 'owner_id'             => null,
                 'event_id'             => $request['event_id'],
                 'price'                => $zone->price, //Falta reducir el porcentaje de promocion
                 'presentation_id'      => $request['presentation_id'],
                 'zone_id'              => $request['zone_id'],
                 'seat_id'              => null,
                 'salesman_id'          => null,
                 'picked_up'            => false,
                 'designee'             => null,
                 'sale_id'              => 1,
                 'created_at'           => new Carbon(),
                 'updated_at'           => new Carbon(),
                ]);

                if(\Auth::user()->role_id == config('constants.salesman')){
                    DB::table('tickets')->where('id',$id)->update(['salesman_id'=>\Auth::user()->id]);
                    DB::table('tickets')->where('id',$id)->update(['picked_up'=>true]);
                    DB::table('tickets')->where('id',$id)->update(['designee'=>null]);
                }

                if($request['designee'] != null){
                    DB::table('tickets')->where('id',$id)->update(['designee'=>$request['designee']]);
                }

                if($sale_id != null){
                    DB::table('tickets')->where('id',$id)->update(['sale_id'=>$sale_id+1]);
                }

                if($request['promotion_id']!=""){
                    $promo = Promotions::find($request['promotion_id']);
                    if($promo->desc != null)
                        DB::table('tickets')->where('id',$id)->decrement('price', $zone->price * ($promo->desc/100));
                }

                //Si existe cliente
                if($request['user_id']!=""){

                    //Asignar cliente
                    DB::table('tickets')->where('id',$id)->update(['owner_id' => $request['user_id']]);

                    //Aumentar puntos de cliente
                    DB::table('users')->where('id', $request['user_id'])->increment('points');

                }

                if ($event->place->rows != null){
                    //Asignar id en caso sea numerado
                    DB::table('tickets')->where('id',$id)->update(['seat_id' => $seats[$i]]);
                }

                array_push($tickets,$id);
                //var_dump('llego');
            }

            DB::commit();

        }catch (\Exception $e){
            DB::rollback();
            return back()->withInput($request->except('seats'))->withErrors(['Por favor intentelo nuevamente']);
        }

        session(['tickets'=>$tickets]);
        if(\Auth::user()->role_id == config('constants.salesman')){
            return redirect()->route('ticket.success.salesman');
        }else if(\Auth::user()->role_id == config('constants.client')){
            return redirect()->route('ticket.success.client');
        }

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
        $tickets = array();
        $tickets_id = session('tickets');
        foreach ($tickets_id as $ticket_id) {
            array_push($tickets,Ticket::find($ticket_id));
        }
        return view('internal.client.successBuy', compact('tickets'));
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

    public function giveawayShow(StoreGiveawayRequest $request)
    {
        $tickets = Ticket::where('sale_id',$request['sale_id'])->get();
        if($tickets == null){
            return back()->withInput()->withErrors(['Esta venta no existe']);
        }else if($tickets[0]->picked_up == true){
            return back()->withInput()->withErrors(['Estos tickets ya fueron recogidos']);
        }else if($tickets[0]->designee != $request['designee'])
            return back()->withInput()->withErrors(['El usuario asignado no es el mismo que el ingresado']);

        return view('internal.salesman.giveawayShow',compact('tickets'));
    }

    public function giveawayConfirm(request $request)
    {
        $tickets = Ticket::where('sale_id',$request['sale_id'])->get();
        foreach ($tickets as $ticket) {
            $ticket->picked_up = true;
            $ticket->save();
        }

        return redirect()->route('salesman.home');
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

    public function getAvailable(request $request)
    {
        $event = Event::find($request['event_id']);

        if($event->place->rows == null){
            $zone_presentation = DB::table('zone_presentation')->where('presentation_id', $request['function_id'])->where('zone_id', $request['zone_id'])->first();
            $availables = $zone_presentation->slots_availables;
        }else{
            $availables = 0;
            $slot_presentation = DB::table('slot_presentation')->where('presentation_id',$request['function_id'])->where('status',config('constants.seat_available'))->get();
            foreach($slot_presentation as $s_p){
                $slot = Slot::find($s_p->slot_id);
                if($slot->zone->id == $request['zone_id']){
                    $availables += 1;
                }
            }
        }

        return $availables;
    }

    public function getSlots(request $request)
    {
        $slots = [];
        $slot_presentation = DB::table('slot_presentation')->where('presentation_id',$request['function_id'])->where('status',config('constants.seat_available'))->get();
        foreach ($slot_presentation as $s_p) {
            $slot = Slot::find($s_p->slot_id);
            if($slot->zone->id == $request['zone_id']){
                $slots[$slot->id] = "F".$slot->row." C".$slot->column;
            }
        }

        return $slots;
    }

    public function getTakenSlots(request $request)
    {
        $event = Event::find($request['event_id']);
        if($event->place->rows != null){
            $slots = [];
            $taken = [];
            $reserved = [];
            $slot_presentation = DB::table('slot_presentation')->where('presentation_id',$request['function_id'])->where('status',config('constants.seat_taken'))->get();
            foreach ($slot_presentation as $s_p) {
                $slot = Slot::find($s_p->slot_id);
                if($slot->zone->id == $request['zone_id']){
                    array_push($taken, $slot->row."_".$slot->column);
                }
            }
            $slot_presentation = DB::table('slot_presentation')->where('presentation_id',$request['function_id'])->where('status',config('constants.seat_reserved'))->get();
            foreach ($slot_presentation as $s_p) {
                $slot = Slot::find($s_p->slot_id);
                if($slot->zone->id == $request['zone_id']){
                    array_push($reserved, $slot->row."_".$slot->column);
                }
            }
            array_push($slots,$taken);
            array_push($slots,$reserved);
        } else {
            $slots = -1;
        }

        return $slots;
    }

    public function getZone(request $request)
    {
        $zone = Zone::find($request['zone_id']);
        return $zone;
    }

    public function getPromo(request $request)
    {
        $maxDiscount = 0;
        $bestPromo = null;
        if($request['type_id']==config('constants.credit')){
            $promos = Promotions::where('event_id',$request['event_id'])->where('access_id',2)->where('startday','<',Carbon::now())->where('endday','>',Carbon::now())->get();
        }else if($request['type_id']==config('constants.cash')){
            $promos = Promotions::where('event_id',$request['event_id'])->where('access_id',1)->where('startday','<',Carbon::now())->where('endday','>',Carbon::now())->get();
        }else{
            $promos = null;
        }

        if($promos){
            foreach ($promos as $key => $promo) {
                if ($promo->typePromotion == config('constants.discount')){
                    if ($promo->desc > $maxDiscount){
                        $maxDiscount = $promo->desc;
                        $bestPromo = $promo;
                    }
                }else{
                    //GG OFERTA X por Y ÑO QUIERO
                }

            }
        }
        return $bestPromo;
    }
    public function getTicketToJson($id)
    {
        $ticket =Ticket::findOrFail($id);
        return $ticket;
    }
}

