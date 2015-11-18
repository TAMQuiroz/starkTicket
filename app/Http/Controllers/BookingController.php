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
use Mail;
use DateTime; use Date;
use Session;

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

                $slot = DB::table('slot_presentation')->where('slot_id',$seat_id)->where('presentation_id', $request['presentation_id'])->first();
                
                array_push($seats_array, Slot::where('id', $seat_id)->get()->first());
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
             'promo_id'             => null,
             'quantity'             => $nTickets,
             'salesman_id'          => null,
             'picked_up'            => false,
             'discount'             => null,
             'designee'             => \Auth::user()->di,
             'total_price'          => $zone->price * $nTickets,
             'created_at'           => new Carbon(),
             'updated_at'           => new Carbon(),
            ]);

            if($request['dni_recojo'] != null){
                DB::table('tickets')->where('id',$id)->update(['designee'=>$request['dni_recojo']]);
            }

            if ($event->place->rows != null){
                //Asignar id en caso sea numerado
                for($i = 0; $i < $nTickets; $i++){
                    DB::table('slot_presentation')
                        ->where('slot_id', $seats[$i])
                        ->where('presentation_id', $request['presentation_id'])
                        ->update(['sale_id' => $id]);
                }
            }

            array_push($tickets,$id);
            //var_dump('llego');


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
	
	public function searchBooking()
	{
		return view('internal.salesman.payBooking');
	}

    public function showPayBooking(Request $request){
        $codigo = $request['reserve_code'];
        $tickets = Ticket::where('reserve',$codigo)->get()->first();
        $event = $tickets->first()->event;
        $zone = $tickets->first()->zone;
        $presentation = $tickets->first()->presentation;
        return view('internal.salesman.payBookingShow',
            array('tickets' => $tickets, 'event' => $event,
                'zone' => $zone, 'presentation' => $presentation,
                'reserve' => $codigo));
    }

    public function storePayBooking(Request $request){
        $reserve_id = $request->input('reserve_id');
        $ticket = Ticket::where('reserve', $reserve_id)->get()->first();
        if(empty($ticket))
            return redirect()->back()->withErrors(['error' => 'no hay reservas para el codigo especificado']);
        $nTickets= $ticket->quantity;
        $ticket->payment_date = new Carbon();
        $ticket->cancelled = true;
        $ticket->salesman_id = \Auth::user()->id;
        $ticket->picked_up = true;
        $ticket->updated_at = new Carbon();
        $ticket->reserve = null;
        $id = $ticket->id;
        $ticket->save();
        if($request['promotion_id']!=""){
                $promo = Promotions::find($request['promotion_id']);
                if($promo->desc != null){
                    DB::table('tickets')->where('id',$id)->update(['discount' => $promo->desc]);
                    DB::table('tickets')->where('id',$id)->decrement('total_price', ($promo->desc/100)*($nTickets*$zone->price));
                }else{
                    $pu = Zone::find($request['zone_id'])->price;
                    $quantity = $request['quantity'];
                    $pt = $pu * $quantity;
                    $discTickets = $quantity / $promo->carry;
                    $discTickets = floor($discTickets);
                    $pd = $pt - $discTickets*$pu;
                    $desc = 100 - ($pd/$pt)*100;
                    DB::table('tickets')->where('id',$id)->update(['discount' => $desc]);
                    DB::table('tickets')->where('id',$id)->update(['total_price' => $pd]);
                }
                DB::table('tickets')->where('id',$id)->update(['promo_id' => $promo->id]);
            }
        DB::table('users')->where('id', $request['user_id'])->increment('points', $nTickets);
        DB::table('slot_presentation')->where('sale_id',$ticket->id)->update(['status' => config('constants.seat_taken')]);
        session(['tickets'=>$id]);
        return redirect()->route('ticket.success.salesman');
    }

    public function payReserveStore($reserve_id){
        $tickets = Ticket::where('reserve', $reserve_id);
        if($tickets->isEmpty())
            return redirect()->back()->withErrors(['error' => 'no hay reservas para el codigo especificado']);
        foreach ($tickets as $ticket) {
            $ticket->reserve = null;
            $ticket->payment_date = Carbon::now();
        }
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

    public function sendConfirmationMail($reserve_code){
        $tickets = Ticket::where('reserve', $reserve_code)->get();
        $mail =  $tickets->first()->owner->email;
        Mail::send('internal.client.reserveMail', array('tickets' => $tickets), function($message)use($mail){
            $message->to($mail);
        });
        Session::flash('bookingmailmessage', 'Correo de confirmación de reserva enviado con éxito.');
        return redirect()->route('event.external.show',array($tickets->first()->event_id));
    }

    public function getReservesByDni(Request $request){
        $dni = $request['dni'];
        if(strlen($dni)!=8 || !is_numeric($dni))
            return response()->json('El dni debe tener 8 digitos',400);
        $reservas= Ticket::where('designee',$dni)->whereNotNull('reserve')->lists('reserve')->unique();
        if($reservas->isEmpty())
            return response()->json('No hay reservas con este dni',400);
        $arreglo = array();
        foreach ($reservas as $key=>$value) {
            $tickets= Ticket::where('reserve',$value)->get();
            $arreglo[$key] = ['codigo' => $value, 
            'nombre' => $tickets->first()->event->name,
            //'cantidad' => $tickets->count(),
            'cantidad' => $tickets->first()->quantity,
            'zona'    => $tickets->first()->zone->name,
            'funcion' => date('d-m-Y',$tickets->first()->presentation->starts_at)];
        }
        return $arreglo;
    }
}