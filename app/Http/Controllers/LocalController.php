<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Local\StoreLocalRequest;
use App\Http\Requests\Local\UpdateLocalRequest;
use App\Models\Local;
use App\Services\FileService;
use App\Models\Event;
use App\Models\Distribution;
use App\Models\Zone;
use DB;
use App\Models\Presentation;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
        $this->file_service = new FileService();
    }
    public function index()
    {
        $locals = Local::paginate(10);
        $locals->setPath('local');
        return view('internal.admin.locals.locals',compact('locals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.admin.locals.newLocal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocalRequest $request)
    {
        //
        $input = $request->all();
        

        $local               =   new Local;
        $local->name         =   $input['name'];
        $local->address      =   $input['address'];
        $local->district     =   $input['district'];
        $local->province     =   $input['province']; 
        $local->state        =   $input['state'];  
        
        if($input['local_type'] == config('constants.numbered')){
            $local->rows          =   $input['row'];
            $local->columns       =   $input['column'];
            $local->capacity     =   $local->rows * $local->columns;
        }else{
            $local->capacity     =   $input['capacity'];
        }
        
        //Control de subida de imagen
        $local->image        =   $this->file_service->upload($request->file('image'),'local');
        //var_dump($seats);die();
        $local->save();
        //sitios
        if($input['local_type'] == config('constants.numbered')){
            $seats = $input['seats'];
            
            foreach ($seats as $key => $value) {
                $column = floor($key/$local->rows)+1;
                $row = ($key - (($column-1)*$local->rows))+1;
                
                $id = DB::table('distribution')->insertGetId(
                ['row'         => $row,
                 'column'      => $column,
                 'local_id'    => $local->id,
                 'seat'        => $value,
                ]);
            }
        }
        
        return redirect('admin/local');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $local = Local::find($id);
        $event = Event::where("local_id",$local->id)->withTrashed()->get();
        return view('internal.admin.locals.editLocal',compact('local','event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocalRequest $request, $id)
    {
        //
        $input = $request->all();
       /* $date_at = strtotime(date("Y-m-d H:i:s"));

        $events = Event::where("local_id",$id)->get();
        foreach ($events as $event){
            $prensentations = Presentation::where("event_id",$event->id)->where("cancelled",0)->where("starts_at",">",$date_at)->get();
            if ($prensentations->count() != 0)
                return back()->withErrors(['No se puede editar un local con eventos asociados']);
        }*/
        $local = Local::find($id);

        
        $local->name         =   $input['name'];
        /*$local->capacity     =   $input['capacity'];*/
        $local->address      =   $input['address'];
        $local->district     =   $input['district'];
        $local->province     =   $input['province']; 
        $local->state        =   $input['state'];
        if($input['local_type'] == config('constants.numbered')){
            $local->rows          =   $input['row'];
            $local->columns       =   $input['column'];
            $local->capacity     =   $local->rows * $local->columns;
        }else if  ($input['local_type'] == config('constants.notNumbered')) {
            $local->rows          =   null;
            $local->columns       =   null;
            $local->capacity     =   $input['capacity'];
        }        
        
        //Control de subida de imagen
        if($request->file('image')!=null)
            $local->image        =   $this->file_service->upload($request->file('image'),'local');


        $local->save();
        return redirect('admin/local');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $events = Event::where('local_id',$id)->get();
       
        if ($events->count()==0){
            $local = Local::find($id);
            $local->delete();
        }else{
            return back()->withErrors(['No se puede eliminar un local con eventos asociados']);
        }
        
        return redirect('admin/local');
    }

    public function getLocalSeatArray(Request $request){
        $local_id = $request['local_id'];
        $local = Local::find($local_id);
        if(empty($local)|| $local == null) return response()->json('invalid local id', 400); 
        $distribution = $local->distribution;
        $arreglo = array();
        for($i = 1; $i <= $local->rows; $i++){
            $texto = '';
            for($j = 1; $j<= $local->columns;$j++){
                $dist = Distribution::where('row', $i)->where('column', $j)
                ->where('local_id', $local_id)->get()->first();
                
                if($dist->seat)
                    $texto = $texto.'a';
                else $texto = $texto.'_';
            }
            array_push($arreglo, $texto);
        }
        return $arreglo;
    }

    public function getZoneSeatArray(Request $request){
        $zona = Zone::find($request['zone_id']);
        $local = $zona->event->place;
        $arreglo = array();
        $slots = $zona->slots;
        /*
        for($j=$zona->start_row; $j<$zona->start_row +$zona->rows; $j++){
            $texto = '';
            for($i=$zona->start_column; $i<$zona->start_column +$zona->columns; $i++){
                $res = $slots->where('column', $i)->where('row', $j);
                if($res->isEmpty())
                    $texto = $texto.'_';
                else $texto = $texto.'a';
            }
            array_push($arreglo, $texto);
        }*/
        for($j=1; $j<=$local->rows; $j++){
            $texto = '';
            for($i =1;$i<=$local->columns;$i++){
                $res = $slots->where('column', $i)->where('row', $j);
                if($res->isEmpty())
                    $texto = $texto.'_';
                else $texto = $texto.'a';
            }
            array_push($arreglo, $texto);
        }
        return $arreglo;
    }

    public function getZoneSeatsIds(Request $request){
        $zona = Zone::find($request['zone_id']);
        $local = $zona->event->place;
        $arreglo = array();
        $slots = $zona->slots;
        foreach ($slots as $slot) {
            $id = $slot->row."_".$slot->column;
            array_push($arreglo, $id);
        }
        return $arreglo;
    }
}
