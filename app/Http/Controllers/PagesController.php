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
        $upcoming   = Event::where('selling_date','>',strtotime(Carbon::now()))->where('publication_date','>',strtotime(Carbon::now()))->get();
        return view('external.home',array('destacados'=>$destacados,'upcoming'=>$upcoming));
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
        $date_at = strtotime(date("Y-m-d"));
        $events = Event::where(["publication_date"=>$date_at,"cancelled"=>"0"])->get();

        $presentations = Presentation::where("cancelled","0")
                                    ->whereBetween("starts_at",[$date_at,$date_at+86400])
                                    ->get();

        $eventsDate = Event::where("cancelled","0")->where("selling_date",'<=', $date_at)->get();
        $eventInformation = [];
        foreach($eventsDate as $eventDate){
                    $presentationsDate = Presentation::where("cancelled","0")
                                    ->whereBetween("starts_at",[$date_at,$date_at+86400])
                                    ->where("event_id",$eventDate->id)
                                    ->get();
                    $presentationInformation = [];
                    if (count($presentationsDate)!=0){
                        foreach ($presentationsDate as $pre){
                            array_push($presentationInformation, array($pre->starts_at));
                        }
                        array_push($eventInformation, array($eventDate->image, $eventDate->id, $eventDate->name, $eventDate->place->name, $eventDate->place->address, $eventDate->category->name, $presentationInformation));

                    }
                    
            
        }

        return view('external.calendar',["events"=>$events,"date_at"=>$date_at,"presentations"=>$presentations],compact('eventInformation'));
    }

    public function eventsForDate(Request $request)
    {

        $input = $request->all();
        $date_at = strtotime($input['date_at']);

        $presentations = Presentation::where("cancelled","0")
                                    ->whereBetween("starts_at",[$date_at,$date_at+86400])
                                    ->get();

        $eventsDate = Event::where("cancelled","0")->where("selling_date",'<=', $date_at)->get();
        $eventInformation = [];
        foreach($eventsDate as $eventDate){
                    $presentationsDate = Presentation::where("cancelled","0")
                                    ->whereBetween("starts_at",[$date_at,$date_at+86400])
                                    ->where("event_id",$eventDate->id)
                                    ->get();
                    $presentationInformation = [];
                    if (count($presentationsDate)!=0){
                        foreach ($presentationsDate as $pre){
                            array_push($presentationInformation, array($pre->starts_at));
                        }
                        array_push($eventInformation, array($eventDate->image, $eventDate->id, $eventDate->name, $eventDate->place->name, $eventDate->place->address, $eventDate->category->name, $presentationInformation));

                    }
                    
            
        }

        $events = Event::where(["publication_date"=>$date_at,"cancelled"=>"0"])->get();
        return view('external.calendar',["events"=>$events,"date_at"=>$date_at,"presentations"=>$presentations],compact('eventInformation'));
    }


    public function clientHome()
    {

        // Hago el query para obtener las preferencias del usuario
        //return Auth::user()->id;

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
        $events = Event::where("promoter_id",$userId)->paginate(10);
        return view('internal.promoter.home',["events"=>$events]);
    }

    public function adminHome()
    {
        return view('internal.admin.home');
    }

}
