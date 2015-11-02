<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExchangeRate\StoreExchangeRateRequest;
use App\Http\Requests\ExchangeRate\UpdateExchangeRateRequest;
use App\Models\ExchangeRate;
use Carbon\Carbon;
/*use App\Services\FileService;*/

class BusinessController extends Controller
{
    public function cashCount()
    {
        return view('internal.salesman.cashCount');
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
        $dateParStart = Carbon::createFromDate(null, null, 01); // defecto el año y el mes, dia 01
 //$dateParStart =  $dateParStart->format('d-m-y');


        //        $dateParStart =     Carbon::parse($dateParStart)->format('d/m/Y');
        


          $dateParEnd = Carbon::createFromDate(null, null, 01);

            $dateParEnd =$dateParEnd->addMonth(); 
   $dateParEnd =$dateParEnd->subDay(); 

         return view('internal.admin.attendance ', compact('dateParStart' ,  'dateParEnd' )  );

        //return $datePar ;
    }


     public function attendanceDetail()
    {      
      
         return view('internal.admin.attendanceDetail '  );

        //return $datePar ;
    }



}
