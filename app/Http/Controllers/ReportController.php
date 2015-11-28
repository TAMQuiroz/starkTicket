<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Presentation;
use App\Models\ModuleAssigment;
use App\Models\Module;
use App\User;
use App\Role;
use Excel;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function assigmentExcel(Request $request){
        $input = $request->all(); 
        $flagBetweenDates = false;
        $flagFilterAll = false;
        $flagFirstDate = false;
        $flagLastDate  = false;
        //Condiciones que se pueden dar para filtrar la tabla
        if (empty($input['name']) and empty($input['firstDate']) and empty($input['lastDate']))
           $moduleAssigments = ModuleAssigment::all();  
        else{
            if ($input['name'] and empty($input['firstDate']) and empty($input['lastDate'])) {
              // $events = ModuleAssigment::where('name', 'LIKE', '%'.$input['name'].'%')->get();
                $moduleAssigments = DB::table('module_assigments')
                    //->select(DB::raw('module_assigments.id as idAssigment, module_assigments.module_id as idModule, modules.name as nameModule, module_assigments.salesman_id as idSalesman, users.name as nameSalesman, users.lastName as lastnameSalesman, module_assigments.dateAssigments as dateAssigment, module_assigments.dateMoveAssigments as dateMoveAssigment'))
                    ->where('modules.name','LIKE','%'.$input['name'].'%')
                    ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                    ->get();
            }
            elseif ($input['name'] and $input['firstDate'] and empty($input['lastDate'])){
                $moduleAssigments = DB::table('module_assigments')
                    //->select(DB::raw('module_assigments.id as idAssigment, module_assigments.module_id as idModule, modules.name as nameModule, module_assigments.salesman_id as idSalesman, users.name as nameSalesman, users.lastName as lastnameSalesman, module_assigments.dateAssigments as dateAssigment, module_assigments.dateMoveAssigments as dateMoveAssigment'))
                    ->where('modules.name','LIKE','%'.$input['name'].'%')
                    ->where('dateAssigments','>',$input['firstDate'])
                    ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                    ->get();
                $flagFirstDate = true;
            }
            elseif ($input['name'] and empty($input['firstDate']) and $input['lastDate']){
                $moduleAssigments = DB::table('module_assigments')
                    //->select(DB::raw('module_assigments.id as idAssigment, module_assigments.module_id as idModule, modules.name as nameModule, module_assigments.salesman_id as idSalesman, users.name as nameSalesman, users.lastName as lastnameSalesman, module_assigments.dateAssigments as dateAssigment, module_assigments.dateMoveAssigments as dateMoveAssigment'))
                    ->where('modules.name','LIKE','%'.$input['name'].'%')
                    ->where('dateAssigments','<',$input['lastDate'])
                    ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                    ->get();
                $flagLastDate = true;
            }
            elseif (empty($input['name']) and $input['firstDate'] and empty($input['lastDate'])){
                $moduleAssigments = DB::table('module_assigments')
                    //->select(DB::raw('module_assigments.id as idAssigment, module_assigments.module_id as idModule, modules.name as nameModule, module_assigments.salesman_id as idSalesman, users.name as nameSalesman, users.lastName as lastnameSalesman, module_assigments.dateAssigments as dateAssigment, module_assigments.dateMoveAssigments as dateMoveAssigment'))
                    ->where('dateAssigments','>',$input['firstDate'])
                    ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                    ->get();
                $flagFirstDate = true;
            }
            elseif (empty($input['name']) and empty($input['firstDate']) and $input['lastDate']){
                $moduleAssigments = DB::table('module_assigments')
                    //->select(DB::raw('module_assigments.id as idAssigment, module_assigments.module_id as idModule, modules.name as nameModule, module_assigments.salesman_id as idSalesman, users.name as nameSalesman, users.lastName as lastnameSalesman, module_assigments.dateAssigments as dateAssigment, module_assigments.dateMoveAssigments as dateMoveAssigment'))
                    ->where('dateAssigments','<',$input['lastDate'])
                    ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                    ->get();
                $flagLastDate = true;
            }
            elseif (empty($input['name']) and $input['firstDate'] and $input['lastDate'] ){
                $flagBetweenDates = true;
            }
            elseif ($input['name'] and $input['firstDate'] and $input['lastDate']){
                $flagFilterAll = true;
            }
        }

       // $tickets = Ticket::all();
        $assigmentsInformation = [];
                       
        if ($flagBetweenDates){
            $fechaIni = $input['firstDate'];
            $fechaFin = $input['lastDate'];
            $moduleAssigments =  DB::table('module_assigments')
                                ->whereBetween('dateAssigments',[ $fechaIni,  $fechaFin ])
                                ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                                ->get();
            foreach ($moduleAssigments as $moduleAssigment){
            // pueden ser muchos eventos. Necesito información para llenar la tabla
            //filtro fechas si es necesario
                 
                $module = Module::find($moduleAssigment->module_id); 
                $salesman = User::find($moduleAssigment->salesman_id); 
            
                if ($moduleAssigment->dateMoveAssigments !=null ){
                    $moveAss = $moduleAssigment->dateMoveAssigments;
                }
                else {
                    $moveAss = "Vigente";
                }
                array_push($assigmentsInformation,array($module->name, $salesman->name, $salesman->lastname, $moduleAssigment->dateAssigments , $moveAss ));
            }  

        }

        elseif ($flagFilterAll){ 
            $fechaIni = $input['firstDate'];
            $fechaFin = $input['lastDate'];
            $moduleAssigments =  DB::table('module_assigments')
                                ->whereBetween('dateAssigments',[ $fechaIni,  $fechaFin ])
                                ->where('modules.name','LIKE','%'.$input['name'].'%')
                                ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                                ->get();
            foreach ($moduleAssigments as $moduleAssigment){
                $module = Module::find($moduleAssigment->module_id); 
                $salesman = User::find($moduleAssigment->salesman_id); 
            
                if ($moduleAssigment->dateMoveAssigments !=null ){
                    $moveAss = $moduleAssigment->dateMoveAssigments;
                }
                else {
                    $moveAss = "Vigente";
                }
                array_push($assigmentsInformation,array($module->name, $salesman->name, $salesman->lastname, $moduleAssigment->dateAssigments , $moveAss ));
            }

        }
        else{
            foreach ($moduleAssigments as $moduleAssigment){
            // pueden ser muchos eventos. Necesito información para llenar la tabla
            //filtro fechas si es necesario
                 
                $module = Module::find($moduleAssigment->module_id); 
                $salesman = User::find($moduleAssigment->salesman_id); 
            
                if ($moduleAssigment->dateMoveAssigments !=null ){
                    $moveAss = $moduleAssigment->dateMoveAssigments;
                }
                else {
                    $moveAss = "Vigente";
                }
                array_push($assigmentsInformation,array($module->name, $salesman->name, $salesman->lastname, $moduleAssigment->dateAssigments , $moveAss ));
            }  
        }
        
    


        Excel::create('Reporte de asignacion starkticket', function ($excel) use($assigmentsInformation,$flagBetweenDates,$flagFilterAll,$flagFirstDate,$flagLastDate,$input){
          $excel->sheet('Reporte de Asignacion', function($sheet) use($assigmentsInformation,$flagBetweenDates,$flagFilterAll,$flagFirstDate,$flagLastDate,$input) {

                $sheet->mergeCells('A1:G2');
                $sheet->setCellValue('A1',"Reporte de Asignacion de Puntos de Venta");
                $sheet->cells('A1:G1',function($cells){

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontSize(30);

                });      

            
                $sheet->mergeCells('A3:G3');
                if ($flagBetweenDates or $flagFilterAll) $sheet->setCellValue('A3','Fecha Asignacion desde '.$input['firstDate'].'  hasta '.$input['lastDate']);
                elseif ($flagFirstDate or $flagLastDate ) {
                    if ($flagFirstDate) $sheet->setCellValue('A3','Fecha Asignacion desde '.$input['firstDate']);
                    elseif ($flagLastDate) $sheet->setCellValue('A3','Fecha Asignacion hasta '.$input['lastDate']);
                }
                else $sheet->setCellValue('A3',"No hay rango de fechas de Asignacion");
                $sheet->cells('A3:G3',function($cells){

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontSize(14);

                });      
            



                $sheet->setBorder('B4:F200','thin');
                $sheet->setCellValue('B4', "Nombre del modulo");
                $sheet->setCellValue('C4', "Nombres del Vendedor");
                $sheet->setCellValue('D4', "Apellidos del Vendedor");
                $sheet->setCellValue('E4', "Fecha de Asignación");
                $sheet->setCellValue('F4', "Fecha de Desasociación");
                //$sheet->setCellValue('E4', "Entradas vendidas módulo");
                //$sheet->setCellValue('F4', "Subtotal");
                //$sheet->setCellValue('G4', "Total");
                
                //$cells->setAlignment('center');
                //$sheet->cells('A4:G4',function($cells){
                $sheet->cells('B4:F4',function($cells){

                    $cells->setFontWeight('bold');
                    $cells->setBackground('#008000');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });

              //  $sheet->cells('A4:G500',function($cells){
                $sheet->cells('B4:F4',function($cells){
                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });


                $sheet->setWidth(
                    array(
                        'B' => '30',
                        'C' => '30',
                        'D' => '30',
                        'E' => '30',
                        'F' => '30'
                        //'E' => '30',
                        //'F' => '15',
                        //'G' => '15'                                               

                    )

                );

                $sheet->setHeight(
                    array(   
                        '1' => '20'
                    )

                );

                $data = $assigmentsInformation;
                $sheet->fromArray($data, true, 'B5', true, false);

          });




        })->download('xlsx'); 
        return redirect('admin/report/assignment');
    }

    public function actionExcel(Request $request){
      
        
        $input = $request->all(); 
        $flagBetweenDates = false;
        $flagFilterAll = false;
        //Condiciones que se pueden dar para filtrar la tabla
        if (empty($input['name']) and empty($input['firstDate']) and empty($input['lastDate']))
           $events = Event::all();  
        else{
            if ($input['name'] and empty($input['firstDate']) and empty($input['lastDate'])) {
               $events = Event::where('name', 'LIKE', '%'.$input['name'].'%')->get();
            }
            elseif (empty($input['name']) and $input['firstDate'] and $input['lastDate'] ){
                $flagBetweenDates = true;
            }
            elseif ($input['name'] and $input['firstDate'] and $input['lastDate']){
                $flagFilterAll = true;
            }
        }

        $tickets = Ticket::all();
        $eventInformation = [];
                       
        if ($flagBetweenDates){
                
            $fechaIni = strtotime($input['firstDate']) ;
            $fechaFin = strtotime($input['lastDate']) + 86400 ;
            //return $fechaFin;
            
            $eventsDate = Presentation::whereBetween('starts_at',[ $fechaIni,  $fechaFin ])->get();
            foreach($eventsDate as $eventDate){

                    $event= Event::where('id','=', $eventDate->event_id)->where('cancelled','=',0)->get(); 
                    $tickets = Ticket::where('presentation_id','=', $eventDate->id)->get();
                    $onlineTickets = 0;  $presentialTicket = 0;
                    $subTotalOnline = 0; $subTotalPresential = 0;
                    foreach ($tickets as $ticket){
                        if ( $ticket->cancelled != 1){
                            if (empty($ticket->salesman_id)) {
                                $onlineTickets = $onlineTickets + $ticket->quantity;
                                $subTotalPresential = $subTotalPresential + $ticket->total_price;
                            }
                            else {
                                $presentialTicket = $presentialTicket + $ticket->quantity;
                                $subTotalOnline = $subTotalOnline + $ticket->total_price;
                            }
                        }
                    }
                    array_push($eventInformation,array($event[0]->name, date("d/m/Y",$eventDate->starts_at) , $onlineTickets, $subTotalPresential,$presentialTicket, $subTotalOnline, $subTotalPresential + $subTotalOnline));
            
            }


        }

        elseif ($flagFilterAll){

            
            $fechaIni = strtotime($input['firstDate']) ;
            $fechaFin = strtotime($input['lastDate']) + 86400 ;
            //return $fechaFin;
            
            $eventsDate = Presentation::whereBetween('starts_at',[ $fechaIni,  $fechaFin ])->get();
            foreach($eventsDate as $eventDate){

                    //return $eventsDate;
                    $event =  Event::where('name', 'LIKE', '%'.$input['name'].'%')->where('cancelled','=',0)->where('id','=', $eventDate->event_id)->get(); 
                    
                    if ($event->count() != 0) {
                        $tickets = Ticket::where('presentation_id','=', $eventDate->id)->get();
                        $onlineTickets = 0;  $presentialTicket = 0;
                        $subTotalOnline = 0; $subTotalPresential = 0;
                        foreach ($tickets as $ticket){
                           if ( $ticket->cancelled != 1){
                            if (empty($ticket->salesman_id)) {
                                $onlineTickets = $onlineTickets + $ticket->quantity;
                                $subTotalPresential = $subTotalPresential + $ticket->total_price;
                            }
                            else {
                                $presentialTicket = $presentialTicket + $ticket->quantity;
                                $subTotalOnline = $subTotalOnline + $ticket->total_price;
                            }
                        }
                    }
                        array_push($eventInformation,array($event[0]->name, date("d/m/Y",$eventDate->starts_at) , $onlineTickets, $subTotalPresential,$presentialTicket, $subTotalOnline, $subTotalPresential + $subTotalOnline));
                    }
            }

        }
        else{
            foreach ($events as $event){
            // pueden ser muchos eventos. Necesito información para llenar la tabla
            //filtro fechas si es necesario
                 
                $eventsDate = Presentation::where('event_id','=', $event->id)->where('cancelled','=',0)->get(); 
                foreach ($eventsDate as $eventDate){
                    $tickets = Ticket::where('presentation_id','=', $eventDate->id)->get();
                    $onlineTickets = 0;  $presentialTicket = 0;
                    $subTotalOnline = 0; $subTotalPresential = 0;
                    foreach ($tickets as $ticket){
                        if (empty($ticket->salesman_id)) {
                            $onlineTickets = $onlineTickets + $ticket->quantity;
                            $subTotalPresential = $subTotalPresential + $ticket->total_price;
                        }
                        else {
                            $presentialTicket = $presentialTicket + $ticket->quantity;
                            $subTotalOnline = $subTotalOnline + $ticket->total_price;
                        }
                    }
                    array_push($eventInformation,array($event->name, date("d/m/Y",$eventDate->starts_at) , $onlineTickets, $subTotalPresential,$presentialTicket, $subTotalOnline, $subTotalPresential + $subTotalOnline));
                }
            }  
        }
        

        $objPHPExcel = Excel::create('Reporte de ventas starkticket', function ($excel) use($eventInformation,$flagBetweenDates,$input){
          $excel->sheet('Reporte de ventas', function($sheet) use($eventInformation,$flagBetweenDates,$input) {


                $sheet->mergeCells('A1:G2');
                $sheet->setCellValue('A1',"Reporte de ventas de tickets");
                $sheet->cells('A1:G1',function($cells){

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontSize(30);

                });      

            
                $sheet->mergeCells('A3:G3');
                if ($flagBetweenDates) $sheet->setCellValue('A3','Fecha desde '.$input['firstDate'].'  hasta '.$input['lastDate']);
                else $sheet->setCellValue('A3',"");
                $sheet->cells('A3:G3',function($cells){

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontSize(14);

                });      
            

                $cantidad = count($eventInformation)+4;

          
                $sheet->setBorder('A4:G' . $cantidad ,'thin');
                $sheet->setCellValue('A4', "Nombre del evento");
                $sheet->setCellValue('B4', "Fecha del evento");
                $sheet->setCellValue('C4', "Entradas vendidas online");
                $sheet->setCellValue('D4', "Subtotal");
                $sheet->setCellValue('E4', "Entradas vendidas módulo");
                $sheet->setCellValue('F4', "Subtotal");
                $sheet->setCellValue('G4', "Total");
                
                //$cells->setAlignment('center');
                $sheet->cells('A4:G4',function($cells){

                    $cells->setFontWeight('bold');
                    $cells->setBackground('#008000');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });

                $sheet->cells('A4:G500'  ,function($cells){

                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });


                $sheet->setWidth(
                    array(
                        'A' => '30',
                        'B' => '20',
                        'C' => '30',
                        'D' => '15',
                        'E' => '30',
                        'F' => '15',
                        'G' => '15'                                               

                    )

                );

                $sheet->setHeight(
                    array(   
                        '1' => '20'
                    )

                );

                $data = $eventInformation;
                $sheet->fromArray($data, true, 'A5', true, false);

          });




        })->export('pdf');
    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "assggas";
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSales()
    {

        $events = Event::all();
        $tickets = Ticket::all();
        $eventInformation = [];
                
        foreach ($events as $event){

            // pueden ser muchos eventos. Necesito información para llenar la tabla
            $eventsDate = Presentation::where('event_id','=', $event->id)->where('cancelled','=',0)->get();
            foreach ($eventsDate as $eventDate){
                $tickets = Ticket::where('presentation_id','=', $eventDate->id)->get();
                $onlineTickets = 0;  $presentialTicket = 0;
                $subTotalOnline = 0; $subTotalPresential = 0;
                foreach ($tickets as $ticket){
                   if ( $ticket->cancelled != 1){
                            if (empty($ticket->salesman_id)) {
                                $onlineTickets = $onlineTickets + $ticket->quantity;
                                $subTotalPresential = $subTotalPresential + $ticket->total_price;
                            }
                            else {
                                $presentialTicket = $presentialTicket + $ticket->quantity;
                                $subTotalOnline = $subTotalOnline + $ticket->total_price;
                            }
                    }
                }
                array_push($eventInformation,array($event->name,$eventDate->id, date("d/m/Y",$eventDate->starts_at) , $onlineTickets, $subTotalPresential,$presentialTicket, $subTotalOnline, $subTotalPresential + $subTotalOnline));
            }

        }
        
        //
        //return $eventInformation;
        return view('internal.admin.reports.sales',compact('eventInformation'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAssistance()
    {
        return view('internal.admin.reports.assistance');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function showAssigment()
    {
        

        $moduleAssigments = ModuleAssigment::all();
        
        $assiInformation = [];
                
        foreach ($moduleAssigments as $moduleAssigment){

            // pueden ser muchos eventos. Necesito información para llenar la tabla
            $module = Module::find($moduleAssigment->module_id);
            $salesman = User::find($moduleAssigment->salesman_id);
            $role = Role::find($salesman->role_id);
            array_push($assiInformation,array($module->name,$salesman->name,$salesman->lastname, $moduleAssigment->dateAssigments, $moduleAssigment->dateMoveAssigments,$role->description ));
        }

        //$array_module = [];
        $modules_list = Module::all()->lists('name','id');
         $array = ['modules_list' =>$modules_list];
       


        return view('internal.admin.reports.assignment',compact('assiInformation'),$array);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
