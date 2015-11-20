<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Highlight;
use App\Models\AttendanceDetail;
use Auth;
use App\User;
use App\Models\Preference;
use App\Models\Event;
use App\Models\About;
use Carbon\Carbon;
use App\Models\Presentation;
use DB;

class PagesController extends Controller
{
    public function home()
    {
        $destacados = Highlight::where('active','1')->get();
        return view('external.home',array('destacados'=>$destacados));
    }

    public function about()
    {
        $about = About::all()->first();
        return view('external.about', compact('about'));
    }

    public function modules()
    {
        return view('external.modules');
    }

    public function calendar(request $request)
    {
         $events = Event::where('cancelled','=',0)->get();
        $eventInformation = [];
                
        foreach ($events as $event){
           
            $eventsDates = Presentation::where('event_id','=', $event->id)->where('cancelled','=',0)->get();
            $count = 0;
            foreach ($eventsDates as $eventDate){
                $date =   date("Y-m-d H:d:s",$eventDate->starts_at);
               

               /*if ($infoDate!=null){
                    
                    $thatDay =  $infoDate;
                    if ($date >= $thatDay && ($date->month == $thatDay->month && $date->year == $thatDay->year && ($date->day == $thatDay->day) ) ){
                        $count+=1; 

                    }
                }
                else {*/
                    if ($date >= Carbon::now() && $date < Carbon::tomorrow()){
                            $count += 1;
                     }
                //}
            }
            if ($count != 0){
                
                array_push($eventInformation,array($event->image, $event->name,$event->place->name, $event->place->address , $event->category->name,$event->id));
            }  
            

        }
        
        return view('external.calendar',compact('eventInformation'));
    }
    public function findcalendar(request $request){

        $infoDate = $request['firstDate'];
        return rediret('calendar',compact('infoDate'));
    }
    

    public function clientHome()
    {

        // Hago el query para obtener las preferencias del usuario
        $clientes = Preference::where('idUser', '=' , Auth::user()->id)->get();

        $clientPreferences = [];

        foreach($clientes as $cliente){
                $preferencias = Event::where('category_id', '=', $cliente->idCategories)->get(); // puede haber varios eventos del mismo tipo
                foreach($preferencias as $preference){
                    array_push($clientPreferences, $preference);
                }
        }


        //return $clientPreferences;

        //return $cliente;
        // iteracion
        /*

        */
        //aca estan las páginas que le gustan al cliente


        return view('internal.client.home',compact('clientPreferences'));
    }

    public function salesmanHome()
    {
        return view('internal.salesman.home');
    }

    public function promoterHome()
    {
        $userId = Auth::user()->id;
        $events = Event::where("cancelled","0")->paginate(10);
        return view('internal.promoter.home',["events"=>$events]);
    }

    public function adminHome()
    {
        return view('internal.admin.home');
    }

}
