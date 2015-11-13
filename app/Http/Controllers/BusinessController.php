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
use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\AttendanceDetail;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Module;
use DB;

/*use App\Services\FileService;*/

class BusinessController extends Controller
{
    public function cashCount()
    {
        //$user = Auth::user();
                
        $sales = DB::table('tickets')
                    ->select(DB::raw('payment_date, users.name as clientName, users.lastname as clientLast, events.name as eventName, zones.name as zoneName, tickets.price as zonePrice, tickets.discount as tiDiscount, presentations.starts_at as funtionTime, tickets.quantity as totalTicket, (tickets.total_price) as subtotal'))
                    ->where('payment_date','<',new Carbon())->where('payment_date','>=',Carbon::today())->where('salesman_id',\Auth::user()->id)
                    //->groupBy('payment_date')
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
                    ->select(DB::raw('modules.cash as cashMo'))
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
                    ->select(DB::raw('devolutions.created_at, users.name as clientName, users.lastname as clientLast, events.name as eventName, zones.name as zoneName, tickets.price as zonePrice, tickets.discount as tiDiscount, presentations.starts_at as funtionTime, tickets.quantity as totalTicket, tickets.total_price as subtotal'))
                    ->where('devolutions.created_at','<',new Carbon())->where('devolutions.created_at','>=',Carbon::today())->where('user_id',\Auth::user()->id)
                    //->groupBy('devolutions.created_at')
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
         $module = Module::find(\Auth::user()->module_id);
         $module->cash    = $request['cash'];
         $module->save();
             
         return redirect('salesman/cash_count');
    }

    public function about()
    {
        return view('internal.admin.about');
    }

    public function system()
    {
        return view('internal.admin.system');
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



}
