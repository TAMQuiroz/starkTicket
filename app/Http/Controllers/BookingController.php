<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Models\Ticket;
use App\Models\Slot;
use App\Models\Event;
use App\Models\Presentation;
use App\Models\Zone;
use App\Http\Requests\Booking\StoreBookingRequest;
use Carbon\Carbon;
use DateTime; use Date;

class BookingController extends Controller
{
	public function create($id)
	{
		$event = Event::find($id);
		$presentations = $event->presentations;
		foreach ($presentations as $presentation) {
			$presentation->starts_at = gmdate("d-m-Y H:i:s ", $presentation->starts_at);
		}
		$presentations = $presentations->lists('starts_at', 'id');
		$zones = Zone::where('event_id', $id)->lists('name', 'id');
		$array = ['event' => $event,
				'presentations' => $presentations,
				'zones'			=> $zones];
		return view('external.booking.create', $array);
	}

	public function store(StoreBookingRequest $request)
	{
		
		$event = Event::find($request['event_id']);
        $zone = Zone::find($request['zone_id']);
        $nTickets = $request['quantity'];
        $codigo_reserva = uniqid();
        $seats_array = array();
        if ($event->place->rows != null){ //Es numerado
            $seats = $request['seats'];

            $seats = $this->getSelectedSlots($seats, $zone->id);
            
            foreach($seats as $seat_id){
                $seat = Slot::find($seat_id);
                array_push($seats_array, $seat);
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
                        ->update(['status' => config('constants.seat_reserved')]);
                }else{
                    //Disminuir capacidad en la zona de esa presentacion
                    DB::table('zone_presentation')->where('zone_id', $request['zone_id'])
                                                  ->where('presentation_id',$request['presentation_id'])
                                                  ->decrement('slots_availables');;
                }
                
                //Crear ticket
                $id = DB::table('tickets')->insertGetId(
                ['payment_date'         => null,
                 'reserve'              => $codigo_reserva,
                 'cancelled'            => 0,
                 'owner_id'             => \Auth::user()->id,
                 'event_id'             => $request['event_id'],
                 'price'                => $zone->price, //Falta reducir el porcentaje de promocion
                 'presentation_id'      => $request['presentation_id'],
                 'zone_id'              => $request['zone_id'],
                 'seat_id'              => null,
                 'created_at'           => new Carbon(),
                 'updated_at'           => new Carbon(),
                ]);

                if($sale_id != null){
                    DB::table('tickets')->where('id',$id)->update(['sale_id'=>$sale_id+1]);
                }

                if($request['promotion_id']!=""){
                    $promo = Promotions::find($request['promotion_id']);
                    if($promo->desc != null)
                        DB::table('tickets')->where('id',$id)->decrement('price', $zone->price * ($promo->desc/100));
                }

                if($request['dni_recojo']!=''||$request['dni_recojo']!=null)
                    DB::table('tickets')->where('id',$id)->update(['designee' => $request['dni_recojo']]);
                
                if ($event->place->rows != null){
                    //Asignar id en caso sea numerado
                    DB::table('tickets')->where('id',$id)->update(['seat_id' => $seats[$i]]);
                }
                
                array_push($tickets,$id);
                //var_dump('llego');
            }

            DB::commit();

        }catch (\Exception $e){
            var_dump($e);
            //dd('rollback');
            DB::rollback();
            return back()->withInput($request->except('seats'))->withErrors(['Por favor intentelo nuevamente']);
        }
        $presentation = Presentation::find($request->input('presentation_id'));
        session(['tickets'=>$tickets]);
        $array = ['event' => $event, 
                'zone'    => $zone,
                'cant'    => $nTickets,
                'eventDate' => gmdate("d-m-Y H:i:s",$presentation->starts_at),
                'codigo'  => $codigo_reserva,
                'seats'   => ''];
        if($event->place->rows != null){
            $array['seats'] = $seats_array;
        } 
		return view('external.booking.results', $array);
	
        //return  $array['seats'][0]->row ;
    }
	
	public function pay($id)
	{
		return view('internal.salesman.payBooking');
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

}