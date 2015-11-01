<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Assistance;
use Auth;
use App\User;
use Carbon\Carbon;


class PagesController extends Controller
{
    public function home()
    {
        return view('external.home');
    }

    public function about()
    {
        return view('external.about');
    }

    public function modules()
    {
        return view('external.modules');
    }

    public function calendar()
    {
        return view('external.calendar');
    }

    public function clientHome()
    {
        return view('internal.client.home');
    }

    public function salesmanHome()
    {

//aqui agregamos una entrada a la asistencia 




       
        $assitance               =   new Assistance ;

        $assitance->tipo         =  1 ;
     
        $assitance->datetime  =        new Carbon() ;

  $assitance->datetime  = $assitance->datetime->subHour(5) ;

        $id = Auth::user()->id;
        $assitance->salesman_id  =   $id;


          $assitance->save();

        //   return redirect('promoter/promotion');
      
      // return $promotions ;






        return view('internal.salesman.home');
    }

    public function promoterHome()
    {
        return view('internal.promoter.home');
    }

    public function adminHome()
    {
        return view('internal.admin.home');
    }

}
