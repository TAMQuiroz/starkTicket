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
        $cashStart = DB::table('users')
                    ->select(DB::raw('modules.cash as valueCash'))
                    ->leftJoin('modules', 'users.module_id', '=', 'modules.id')
                    ->where('users.id',\Auth::user()->id)
                    ->get();

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
        $sumTotal = $sumSale - $sumRefound;

        /*
        foreach ($tickets as $ticket ) {
            $exchangeRate->status         =    0;
            $exchangeRate->finishDate     =   new Carbon();
            $exchangeRate->save();
        }*/
        return view('internal.salesman.cashCount',compact('sales','refunds','sumSale','sumRefound','sumTotal','cashStart'));
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
