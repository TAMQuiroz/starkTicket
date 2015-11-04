<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExchangeRate\StoreExchangeRateRequest;
use App\Http\Requests\ExchangeRate\UpdateExchangeRateRequest;
use App\Models\ExchangeRate;


use Auth;
use App\User;
use Carbon\Carbon;


use App\Models\Attendance;
use App\Models\AttendanceDetail;
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



    public function attendanceSubmit(Request $request,  $idSalesman)
    {       




        $input = $request->all();




        $salesman = User::find( $idSalesman ); 


        $dateParStart      =     $input['dateIni']    ;
      $dateParEnd =    $input['dateEnd']     ; 


       
//traemos los datos desde la bd 
  $id = $idSalesman ;

        $Attendances = Attendance::whereBetween('datetime' , [$dateParStart, $dateParEnd] )->where('salesman_id', $id) ->get();
        
     






//return date( "m/d/Y", strtotime($Attendances[0]->datetime));



 // $Attendances[0]->datetime->dob->format('Y-m-d');


     return view('internal.admin.attendance ', compact('Attendances', 'dateParStart' , 'dateParEnd' , 'interval' , 'salesman')  );

// return  $input;
   
 

    }



    public function attendance(Request $request,  $idSalesman)
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






//return date( "m/d/Y", strtotime($Attendances[0]->datetime));



 // $Attendances[0]->datetime->dob->format('Y-m-d');


     return view('internal.admin.attendance ', compact('Attendances', 'dateParStart' , 'dateParEnd' , 'interval' , 'salesman')  );

//return  $input;
   
 

    }



     public function attendanceDetail(  $idAttendance )
    {      


        $detailsAttendances = AttendanceDetail::where('attendance_id' ,$idAttendance )->get();
             $index = 0 ;





         return view('internal.admin.attendanceDetail '  , compact('detailsAttendances' , 'index')  );

        // return $detailsAttendances ;
    }



}
