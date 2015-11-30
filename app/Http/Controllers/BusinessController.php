<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExchangeRate\StoreExchangeRateRequest;
use App\Http\Requests\ExchangeRate\UpdateExchangeRateRequest;
use App\Models\ExchangeRate;
use App\Http\Requests\Attendance\AttendanceRequest;
use App\Http\Requests\Attendance\AttendanceSubmitRequest;
use App\Http\Requests\Attendance\AttendanceUpdate;
use App\Http\Requests\About\UpdateAboutRequest;
use App\Http\Requests\System\UpdateSystemRequest;
use App\Services\FileService;

use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\AttendanceDetail;

use App\Models\Business;
use App\Models\About;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Module;
use App\Models\CashcountHistorial;
use DB;

use App\Http\Requests\Client\PasswordClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use Session;




/*use App\Services\FileService;*/

class BusinessController extends Controller
{
    public function __construct(){
        $this->file_service = new FileService();
    }
    
    public function cashCount()
    {
        //$user = Auth::user();
                
        $sales = DB::table('tickets')
                    ->select(DB::raw('payment_date, users.name as clientName, users.lastname as clientLast, events.name as eventName, zones.name as zoneName, tickets.price as zonePrice, tickets.discount as tiDiscount, presentations.starts_at as funtionTime, tickets.quantity as totalTicket, (tickets.cash_amount) as subtotal'))
                    ->where('payment_date','<',new Carbon())->where('payment_date','>=',Carbon::today())->where('salesman_id',\Auth::user()->id)
                    ->where('tickets.cash_amount','>',0)
                    //->groupBy('payment_date')
                    ->whereNull('tickets.cashCount_register')
                    ->leftJoin('users', 'users.id', '=', 'tickets.owner_id')
                    ->leftJoin('events', 'events.id', '=', 'tickets.event_id')
                    ->leftJoin('zones', 'zones.id', '=', 'tickets.zone_id')
                    ->leftJoin('presentations', 'presentations.id', '=', 'tickets.presentation_id')
                    ->orderBy('payment_date','asc')
                    ->get();
        $sumSale = 0;
        foreach ($sales as $sale) {
            $sumSale += $sale->subtotal; 
        }
        $cashStarts = DB::table('users')
                    ->where('users.id',\Auth::user()->id)
                    ->select(DB::raw('modules.initial_cash as cashMo'))
                    ->leftJoin('modules','modules.id', '=','users.module_id')
                   // ->where('users.id',\Auth::user()->id) -> where('modules.id','users.module_id')
                    ->get();
        $cashFirst = 0;
        $moduleid = \Auth::user()->module_id;
        foreach ($cashStarts as $var) {
            $cashFirst += $var->cashMo; 
        }             
        $refunds = DB::table('devolutions')
                   // ->select(DB::raw('devolutions.created_at, users.name as clientName, users.lastname as clientLast, events.name as eventName, zones.name as zoneName, tickets.price as zonePrice, presentations.starts_at as funtionTime, count(*) as totalTicket, Sum(devolutions.total_price) as subtotal'))
                    ->select(DB::raw('devolutions.created_at, users.name as clientName, users.lastname as clientLast, events.name as eventName, zones.name as zoneName, tickets.price as zonePrice, tickets.discount as tiDiscount, presentations.starts_at as funtionTime, tickets.quantity as totalTicket, devolutions.repayment as subtotal'))
                    ->where('devolutions.created_at','<',new Carbon())->where('devolutions.created_at','>=',Carbon::today())->where('user_id',\Auth::user()->id)
                    //->groupBy('devolutions.created_at')
                    ->whereNull('devolutions.cashCount_register')
                    ->leftJoin('tickets','devolutions.ticket_id','=','tickets.id')
                    ->leftJoin('users', 'users.id', '=', 'tickets.owner_id')
                    ->leftJoin('events', 'events.id', '=', 'tickets.event_id')
                    ->leftJoin('zones', 'zones.id', '=', 'tickets.zone_id')
                    ->leftJoin('presentations', 'presentations.id', '=', 'tickets.presentation_id')
                    ->get();
        $sumRefound = 0;
        foreach ($refunds as $refund) {
            $sumRefound += $refund->subtotal; 
        }
        $sumTotal = $sumSale - $sumRefound + $cashFirst;

        return view('internal.salesman.cashCount',compact('sales','refunds','sumSale','sumRefound','sumTotal','cashFirst','moduleid'));
    }

    public function exchangeRate()
    {
       
        $exchangeRates = ExchangeRate::orderBy('id','desc')->paginate(4);
        $exchangeRates->setPath('exchange_rate');
        return view('internal.admin.exchangeRate',compact('exchangeRates'));
        /* return view('internal.admin.exchangeRate'); */
    }



    public function storeExchangeRate(StoreExchangeRateRequest $request)
    {
        //
        $exchangeRates = ExchangeRate::where('status',1)->get();

        foreach ($exchangeRates as $exchangeRate ) {
            $exchangeRate->status         =    0;
            $exchangeRate->finishDate     =   new Carbon();
            $exchangeRate->save();
        }


        $input = $request->all();

        $module               =   new ExchangeRate;
        $module->buyingRate   =   $input['buyingRate'];
        $module->sellingRate  =   $input['sellingRate'];
        $module->status       =   1;   
        $module->startDate     =  new Carbon();
        //$module->endTime      =   new Carbon($input['endTime']);       
        
        //Control de subida de imagen

        $module->save();
        
        return redirect('admin/config/exchange_rate');
    }
    public function updateCash(request $request)
    {
        
       // $modules = Module::where('id',\Auth::user()->id_module)->get();
         if (Auth::user()->module_id == null){
            return back()->withErrors(['El vendedor no tiene una caja asignada']);
        }

        if ($request['type']==1){
            $module = Module::find(\Auth::user()->module_id);
            if ($module->openModule == true) {
                return back()->withErrors(['La caja ya está abierta. Ya colocó dinero en la caja']);
            }

            $module->openModule     = true;
            $module->initial_cash   = $request['cash'];
            $module->actual_cash    = $request['cash'];
            $module->save();
        }
        elseif ($request['type']==2){
            $module = Module::find(\Auth::user()->module_id);
            if ($module->openModule == false) {
                return back()->withErrors(['La caja ya está cerrada. Abrá la caja primero']);
            }
            $module->openModule     = false;
            $module->initial_cash    = 0;
            $module->actual_cash     = 0;
            $module->save();

             $tickets = DB::table('tickets')
                    ->where('salesman_id','=',\Auth::user()->id)
                    ->where('payment_date','<',new Carbon())->where('payment_date','>=',Carbon::today())
                    ->whereNull('cashCount_register')
                    ->get();
            $timeNow = new Carbon();
            

            $devolutions = DB::table('devolutions')
                    ->where('devolutions.user_id','=',\Auth::user()->id)
                    ->where('devolutions.created_at','<',new Carbon())->where('devolutions.created_at','>=',Carbon::today())
                    ->whereNull('devolutions.cashCount_register')
                    ->get();
            foreach ($devolutions as $devolution) {
                 $devolution->cashCount_register = $timeNow;
                 DB::table('devolutions')
                        ->where('id', $devolution->id)
                        ->update(['cashCount_register' => $timeNow]);

                 //$devolution->save();
            }
            foreach ($tickets as $ticket) {
                $ticket->cashCount_register = $timeNow;
                DB::table('tickets')
                        ->where('id', $ticket->id)
                        ->update(['cashCount_register' => $timeNow]);
               // $ticket->save();
            }

            $cashCount                          =   new CashcountHistorial;
            $cashCount->module_id               =   \Auth::user()->module_id;
            $cashCount->salesman_id             =   \Auth::user()->id;
            $cashCount->initial_cash            =   $request['cashFirst'];
            $cashCount->sales_cash              =   $request['sumeSale'];
            $cashCount->devolutions_cash        =   $request['sumeRefound'];
            $cashCount->total_cash              =   $request['cash'];
            $cashCount->dateCashCount           =   new Carbon($request['dateCashCount']);       
  
            $cashCount->save();
        }

         

             
         return redirect('salesman/cash_count');
    }

    public function about()
    {
        $about = About::all()->first();
        
        return view('internal.admin.about',compact('about'));
    }

    public function aboutUpdate(UpdateAboutRequest $request){
        $about = About::all()->first();
        $about->description = $request['description'];
        $about->mision      = $request['mision'];
        $about->vision      = $request['vision'];
        $about->history     = $request['history'];
        $about->youtube_url = $request['youtube_url'];

        if(isset($request['image'])){
            $about->image = $this->file_service->upload($request->file('image'),'about');
        }

        $about->save();
        Session::flash('message', 'Se actualizaron los datos!');
        Session::flash('alert-class','alert-success');
        return redirect()->back();

    }

    public function system()
    {
        $system = Business::all()->first();
        $modules = Module::all()->lists('name','id');
        
        if($modules->count() == 0){
            $modules = [0 => 'Sin canjeo'];
        }

        return view('internal.admin.system', compact('system','modules'));
    }

    public function systemUpdate(UpdateSystemRequest $request)
    {
        $system = Business::all()->first();
        $system->business_name  =   $request['business_name'];
        $system->ruc            =   $request['ruc'];
        $system->address        =   $request['address'];
        $system->reserve_time   =   $request['reserve_time'];

        if($request['gift_module_id'] == 0){
            $system->gift_module_id =   null;    
        }else{
            $system->gift_module_id =   $request['gift_module_id'];
        }
        
        if(isset($request['logo']))
            $system->logo = $this->file_service->upload($request->file('logo'),'system');

        if(isset($request['favicon']))
            $system->favicon = $this->file_service->upload($request->file('favicon'),'system');

        if($request['exchange_active'] == true){
            $system->exchange_active = true;
        }else if($request['exchange_active'] == false){
            $system->exchange_active = false;
        }

        $system->save();

        Session::flash('message', 'Se actualizaron los datos!');
        Session::flash('alert-class','alert-success');
        return redirect()->back();
    }



    public function attendanceSubmit(AttendanceSubmitRequest $request,  $idSalesman)
    {       

        $input = $request->all();
        $salesman = User::find( $idSalesman ); 

        $dateParStart      =     $input['dateIni']    ;
        $dateParEnd =    $input['dateEnd']     ; 

        $id = $idSalesman ;

        $Attendances = Attendance::whereBetween('datetime' , [$dateParStart, $dateParEnd] )->where('salesman_id', $id) ->get();
        
        return view('internal.admin.attendance ', compact('Attendances', 'dateParStart' , 'dateParEnd' , 'interval' , 'salesman')  );

    }



    public function attendance(AttendanceRequest $request,  $idSalesman)
    {       
        $salesman = User::find( $idSalesman ); 
        $dateParStart = Carbon::createFromDate(null, null, 01); // defecto el año y el mes, dia 01
        $dateParEnd = Carbon::createFromDate(null, null, 01);


        $dateParEnd =$dateParEnd->addMonth(); 
        $dateParEnd =$dateParEnd->subDay(); 
//traemos los datos desde la bd 
        $id = $idSalesman ;

        $Attendances = Attendance::whereBetween('datetime' , [$dateParStart, $dateParEnd] )->where('salesman_id', $id) ->get();

        $interval =   $dateParStart->diff($dateParEnd)->days;
        $interval = $interval /  7 ; 


  return view('internal.admin.attendance ', compact('Attendances', 'dateParStart' , 'dateParEnd' , 'interval' , 'salesman')  );

}



public function attendanceDetail(  $idAttendance )
{      

    $Attendance = Attendance::find($idAttendance);
    $salesman = User::find( $Attendance->salesman_id ); 
    $detailsAttendances = AttendanceDetail::where('attendance_id' ,$idAttendance )->get();
    $index = 0 ;
    return view('internal.admin.attendanceDetail '  , compact('detailsAttendances' , 'index', 'salesman','Attendance')  );

}



       public function attendanceUpdate( AttendanceUpdate $request,  $idAttendanceDetail)
    {       

        $input = $request->all();
        $attendanceDetail = AttendanceDetail::find( $idAttendanceDetail ); 

   
        $attendanceDetail->datetime   =   Carbon::parse($input['horaFin']  ); 

        $attendanceDetail->save();
  
        $Attendance = Attendance::find($attendanceDetail->attendance_id );

        $Attendance->datetimeend    =     Carbon::parse($input['horaFin']  ); 
        $salesman = User::find( $Attendance->salesman_id ); 
        $detailsAttendances = AttendanceDetail::where('attendance_id' , $attendanceDetail->attendance_id )->get();
        $index = 0 ;

        $Attendance->save();

    return view('internal.admin.attendanceDetail '  , compact('detailsAttendances' , 'index', 'salesman','Attendance')  );

      }

public function passwordSalesman()
{
  return view('internal.admin.passwordSalesman');
}


public function passwordUpdateSalesman(PasswordClientRequest $request)
{

        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $auth = Auth::attempt( array(
            'email' => $obj->email,
            'password' => $request->input('password')
            ));
        if ($auth)
        {
            $newPassword = bcrypt($request->input('new_password'));
            $obj->password = $newPassword;
            $obj->save();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Su contraseña fue actualizada!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Contraseña Incorrecta!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('salesman');
}      

}
