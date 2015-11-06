<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExchangeRate\StoreExchangeRateRequest;
use App\Http\Requests\ExchangeRate\UpdateExchangeRateRequest;
use App\Models\ExchangeRate;
use Carbon\Carbon;
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
                    ->select(DB::raw('payment_date, users.name as clientName, users.lastname as clientLast, events.name as eventName, zones.name as zoneName, zones.price as zonePrice, presentations.starts_at as funtionTime, count(*) as totalTicket, Sum(tickets.price) as subtotal'))
                    ->where('payment_date','<',new Carbon())->where('payment_date','>=',Carbon::today())->where('salesman_id',\Auth::user()->id)
                    ->groupBy('payment_date')
                    ->leftJoin('users', 'users.id', '=', 'tickets.owner_id')
                    ->leftJoin('events', 'events.id', '=', 'tickets.event_id')
                    ->leftJoin('zones', 'zones.id', '=', 'tickets.zone_id')
                    ->leftJoin('presentations', 'presentations.id', '=', 'tickets.presentation_id')
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
        $refunds = DB::table('tickets')
                    ->select(DB::raw('refund_date, users.name as clientName, users.lastname as clientLast, events.name as eventName, zones.name as zoneName, zones.price as zonePrice, presentations.starts_at as funtionTime, count(*) as totalTicket, Sum(tickets.price) as subtotal'))
                    ->where('refund_date','<',new Carbon())->where('refund_date','>=',Carbon::today())->where('salesman_id',\Auth::user()->id)
                    ->groupBy('refund_date')
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

        /*
        foreach ($tickets as $ticket ) {
            $exchangeRate->status         =    0;
            $exchangeRate->finishDate     =   new Carbon();
            $exchangeRate->save();
        }*/
        return view('internal.salesman.cashCount',compact('sales','refunds','sumSale','sumRefound','sumTotal','cashFirst','moduleid'));
    }

    public function exchangeRate()
    {
        $exchangeRates = ExchangeRate::paginate(4);
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
         $module = Module::find(\Auth::user()->module_id);
         $module->cash    = $request['cash'];
         $module->save();
             
         return redirect('salesman/cash_count');
    }
    /*public function updateCashCount(request $request)
    {
        $module = Module::find(\Auth::user()->module_id);
        $module->cash    = $request['total'];
        $module->save();
        return redirect('salesman/cash_count');
    }*/

    public function about()
    {
        return view('internal.admin.about');
    }

    public function system()
    {
        return view('internal.admin.system');
    }

    public function attendance()
    {
        return view('internal.admin.attendance');
    }
}
