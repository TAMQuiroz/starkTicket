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

    public function calendar()
    {
        return view('external.calendar');
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
