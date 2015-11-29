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
use App\Models\Attendance;
use App\User;
use App\Role;
use Excel;
use Carbon\Carbon;
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
            $onedaymore = date("Y-m-d",strtotime($input['lastDate']) + 86400);
            //return $holas;

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
                    ->where('dateAssigments','>=',$input['firstDate'])
                    ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                    ->get();
                $flagFirstDate = true;
            }
            elseif ($input['name'] and empty($input['firstDate']) and $input['lastDate']){
                $moduleAssigments = DB::table('module_assigments')
                    //->select(DB::raw('module_assigments.id as idAssigment, module_assigments.module_id as idModule, modules.name as nameModule, module_assigments.salesman_id as idSalesman, users.name as nameSalesman, users.lastName as lastnameSalesman, module_assigments.dateAssigments as dateAssigment, module_assigments.dateMoveAssigments as dateMoveAssigment'))
                    ->where('modules.name','LIKE','%'.$input['name'].'%')
                    ->where('dateAssigments','<',$onedaymore)
                    ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                    ->get();
                $flagLastDate = true;
            }
            elseif (empty($input['name']) and $input['firstDate'] and empty($input['lastDate'])){
                $moduleAssigments = DB::table('module_assigments')
                    //->select(DB::raw('module_assigments.id as idAssigment, module_assigments.module_id as idModule, modules.name as nameModule, module_assigments.salesman_id as idSalesman, users.name as nameSalesman, users.lastName as lastnameSalesman, module_assigments.dateAssigments as dateAssigment, module_assigments.dateMoveAssigments as dateMoveAssigment'))
                    ->where('dateAssigments','>=',$input['firstDate'])
                    ->Join('modules', 'modules.id', '=', 'module_assigments.module_id')
                    ->get();
                $flagFirstDate = true;
            }
            elseif (empty($input['name']) and empty($input['firstDate']) and $input['lastDate']){
                $moduleAssigments = DB::table('module_assigments')
                    //->select(DB::raw('module_assigments.id as idAssigment, module_assigments.module_id as idModule, modules.name as nameModule, module_assigments.salesman_id as idSalesman, users.name as nameSalesman, users.lastName as lastnameSalesman, module_assigments.dateAssigments as dateAssigment, module_assigments.dateMoveAssigments as dateMoveAssigment'))
                    ->where('dateAssigments','<',$onedaymore)
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
            $fechaFin =  date("Y-m-d",strtotime($input['lastDate'])+ 86400);
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
            $fechaFin =  date("Y-m-d",strtotime($input['lastDate'])+ 86400);
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
        

    if ($input['type'] == 1){


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
                else $sheet->setCellValue('A3',"");
                $sheet->cells('A3:G3',function($cells){

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontSize(14);

                });      
            

                $cantidad = count($assigmentsInformation)+4;
                //sacamos el total 


                $sheet->setBorder('B4:F' . $cantidad ,'thin');
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
    }
    else{
        Excel::create('Reporte de asignacion starkticket', function ($excel) use($assigmentsInformation,$flagBetweenDates,$flagFilterAll,$flagFirstDate,$flagLastDate,$input){
          $excel->sheet('Reporte de Asignacion', function($sheet) use($assigmentsInformation,$flagBetweenDates,$flagFilterAll,$flagFirstDate,$flagLastDate,$input) {

                $sheet->mergeCells('A1:E2');
                $sheet->setCellValue('A1',"Reporte de Asignacion de Puntos de Venta");
                $sheet->cells('A1:E1',function($cells){

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontSize(30);

                });      

            
                $sheet->mergeCells('A3:E3');
                if ($flagBetweenDates or $flagFilterAll) $sheet->setCellValue('A3','Fecha Asignacion desde '.$input['firstDate'].'  hasta '.$input['lastDate']);
                elseif ($flagFirstDate or $flagLastDate ) {
                    if ($flagFirstDate) $sheet->setCellValue('A3','Fecha Asignacion desde '.$input['firstDate']);
                    elseif ($flagLastDate) $sheet->setCellValue('A3','Fecha Asignacion hasta '.$input['lastDate']);
                }
                else $sheet->setCellValue('A3',"");
                $sheet->cells('A3:E3',function($cells){

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontSize(14);

                });      
            

                $cantidad = count($assigmentsInformation)+4;


                $sheet->setBorder('A4:E' . $cantidad ,'thin');
                $sheet->setCellValue('A4', "Nombre del modulo");
                $sheet->setCellValue('B4', "Nombres del Vendedor");
                $sheet->setCellValue('C4', "Apellidos del Vendedor");
                $sheet->setCellValue('D4', "Fecha de Asignación");
                $sheet->setCellValue('E4', "Fecha de Desasociación");
                //$sheet->setCellValue('E4', "Entradas vendidas módulo");
                //$sheet->setCellValue('F4', "Subtotal");
                //$sheet->setCellValue('G4', "Total");
                
                //$cells->setAlignment('center');
                //$sheet->cells('A4:G4',function($cells){
                $sheet->cells('A4:E4',function($cells){

                    $cells->setFontWeight('bold');
                    $cells->setBackground('#008000');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });

              //  $sheet->cells('A4:G500',function($cells){
                $sheet->cells('A4:E4',function($cells){
                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });


                $sheet->setWidth(
                    array(
                        'A' => '30',
                        'B' => '30',
                        'C' => '30',
                        'D' => '30',
                        'E' => '30'
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
                $sheet->fromArray($data, true, 'A5', true, false);

          });




        })->export('pdf');   
    }

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
                    dd($event);
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



        if ($input['type'] == 1){
            Excel::create('Reporte de ventas starkticket', function ($excel) use($eventInformation,$flagBetweenDates,$input){
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
                $cellTotal = $cantidad + 1;
                // comentarios no informativos
                $ticketsOnline = 0; //indica entradas vendidas online
                $subTicketsOnline = 0; // indica el subtotal de tickets ONLINE (precio)
                $ticketsModulo = 0;  // indica entradas vendidas modulo
                $subTicketsModulo = 0; // indica el subtotal de tickets modulo (precio)
                $totalPrice = 0; // indica el total de ventas

                foreach($eventInformation as $eventInfo){
                    $ticketsOnline = $ticketsOnline + $eventInfo[2];
                    $subTicketsOnline = $subTicketsOnline + $eventInfo[3];
                    $ticketsModulo = $ticketsModulo + $eventInfo[4];
                    $subTicketsModulo = $subTicketsModulo + $eventInfo[5];
                    $totalPrice = $totalPrice +$eventInfo[6];
                }


                $sheet->setBorder('B'.$cellTotal.':G'. $cellTotal ,'thin');
                $sheet->cells('B'.$cellTotal.':F'. $cellTotal,function($cells){

                    $cells->setFontWeight('bold');
                    //$cells->setBackground('#008000');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });
                $sheet->setCellValue('B'. $cellTotal, "TOTAL");
                $sheet->setCellValue('C'. $cellTotal, $ticketsOnline);
                $sheet->setCellValue('D'. $cellTotal, $subTicketsOnline);
                $sheet->setCellValue('E' . $cellTotal, $ticketsModulo);
                $sheet->setCellValue('F'. $cellTotal, $subTicketsModulo);
                $sheet->setCellValue('G' . $cellTotal, $totalPrice);

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
            })->download('xlsx');
        }
        else{
             Excel::create('Reporte de ventas starkticket', function ($excel) use($eventInformation,$flagBetweenDates,$input){
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
                $cellTotal = $cantidad + 1;
                // comentarios no informativos
                $ticketsOnline = 0; //indica entradas vendidas online
                $subTicketsOnline = 0; // indica el subtotal de tickets ONLINE (precio)
                $ticketsModulo = 0;  // indica entradas vendidas modulo
                $subTicketsModulo = 0; // indica el subtotal de tickets modulo (precio)
                $totalPrice = 0; // indica el total de ventas

                foreach($eventInformation as $eventInfo){
                    $ticketsOnline = $ticketsOnline + $eventInfo[2];
                    $subTicketsOnline = $subTicketsOnline + $eventInfo[3];
                    $ticketsModulo = $ticketsModulo + $eventInfo[4];
                    $subTicketsModulo = $subTicketsModulo + $eventInfo[5];
                    $totalPrice = $totalPrice +$eventInfo[6];
                }


                $sheet->setBorder('B'.$cellTotal.':G'. $cellTotal ,'thin');
                $sheet->cells('B'.$cellTotal.':F'. $cellTotal,function($cells){

                    $cells->setFontWeight('bold');
                    //$cells->setBackground('#008000');
                    $cells->setFontColor('#000000');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });
                $sheet->setCellValue('B'. $cellTotal, "TOTAL");
                $sheet->setCellValue('C'. $cellTotal, $ticketsOnline);
                $sheet->setCellValue('D'. $cellTotal, $subTicketsOnline);
                $sheet->setCellValue('E' . $cellTotal, $ticketsModulo);
                $sheet->setCellValue('F'. $cellTotal, $subTicketsModulo);
                $sheet->setCellValue('G' . $cellTotal, $totalPrice);

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
        
        $salesmans = User::where('role_id',2)->get();

        $assiInformation = [];
        foreach ($salesmans as $salesman) {
            
             $date_at = date_format(date_create(new Carbon()),"Y-m-d");
             $assistances = Attendance::where('salesman_id',$salesman->id)
                            ->where('datetimestart','LIKE', '%'.date_format(date_create(new Carbon()),"Y-m-d").'%')
                            ->get();

                    if (count($assistances)==0){
                        array_push($assiInformation, array($salesman->name,$salesman->lastname,"-","-","No asistió","No asistió","Modulo"));
                    }else {
                        foreach ($assistances as $assistance){
                            $aux = ModuleAssigment::where('dateAssigments', '<' ,$date_at)->where('salesman_id',  $salesman->id)->get()->last();
                                
                            if (count($aux) == 0 ){
                            
                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"-","-","No Tiene Módulo"));
                            }
                            else {
                                $module = Module::find($aux->module_id);
                                $openHour = date_format(date_create($module->starTime),"H:i:s");

                                    if ($openHour >= date_format(date_create($assistance->datetimestart),"H:i:s")){
                                        if ($assistance->datetimeend == null){
                                            array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),"-","Llegó Puntual","Sigue Trabajando",$module->name));
                                        }
                                        else {

                                        
                                            $endHour = date_format(date_create($module->endTime),"H:i:s");
                                            if ($endHour <= date_format(date_create($assistance->datetimeend),"H:i:s")){
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llegó Puntual","Salio Puntual",$module->name));
                                            }
                                            else {
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llego Puntual","Salió Temprano",$module->name));
                                            }
                                        }
                                                
                                    }                  
                                    else{
                                        if ($assistance->datetimeend == null){
                                            array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),"-","Llegó Tarde","Sigue Trabajando",$module->name));
                                        }
                                        else {
                                            $endHour = date_format(date_create($module->endTime),"H:i:s");
                                            if ($endHour <= date_format(date_create($assistance->datetimeend),"H:i:s")){
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llegó Tarde","Salió Puntual",$module->name));
                                            }
                                            else {
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llegó Tarde","Salió Temprano",$module->name));
                                            }
                                        }
                                        
                                    } 
                            }
                            
                        }
                    }
                    


             //}

             
             

         } 
        //return $assiInformation;
                
    



        return view('internal.admin.reports.assistance',compact('assiInformation','date_at'));
    }
    public function assistanceExcel(Request $request){
        if ($request['ty_report']==1){
            $salesmans = User::where('role_id',2)->get();
            $date_at = $request['date_at'];
            $assiInformation = [];
            foreach ($salesmans as $salesman) {
                
               
                 $assistances = Attendance::where('salesman_id',$salesman->id)
                                ->where('datetimestart','LIKE', '%'.date_format(date_create($date_at),"Y-m-d").'%')
                                ->get();

                        if (count($assistances)==0){

                            array_push($assiInformation, array($salesman->name,$salesman->lastname,"-","-","No Asistió","No Asistió","Modulo"));
                        }else {
                            foreach ($assistances as $assistance){
                                $aux = ModuleAssigment::where('dateAssigments', '<' ,$date_at)->where('salesman_id',  $salesman->id)->get()->last();
                                
                                if (count($aux) == 0 ){
                                    array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"-","-","No tiene Módulo"));
                                }
                                else {
                                    $module = Module::find($aux->module_id);
                                    $openHour = date_format(date_create($module->starTime),"H:i:s");

                                    
                                    if ($openHour >= date_format(date_create($assistance->datetimestart),"H:i:s")){
                                        if ($assistance->datetimeend== null){
                                            array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),"-","Llegó Puntual","Sigue Trabajando",$module->name));
                                        }
                                        else {
                                            $endHour = date_format(date_create($module->endTime),"H:i:s");
                                            if ($endHour <= date_format(date_create($assistance->datetimeend),"H:i:s")){
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llegó Puntual","Salio Puntual",$module->name));
                                            }
                                            else {
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llego Puntual","Salió Temprano",$module->name));
                                            }
                                        }
                                            
                                    }                  
                                    else{
                                        if ($assistance->datetimeend == null){
                                            array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),"-","Llegó Tarde","Sigue Trabajando",$module->name));
                                        }
                                        else {
                                            $endHour = date_format(date_create($module->endTime),"H:i:s");
                                            if ($endHour <= date_format(date_create($assistance->datetimeend),"H:i:s")){
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llegó Tarde","Salió Puntual",$module->name));
                                            }
                                            else {
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llegó Tarde","Salió Temprano",$module->name));
                                            }
                                        }
                                        
                                    } 
                                }
                                
                            }
                        }
                        


                 //}

                 
             } 
             return view('internal.admin.reports.assistance',compact('assiInformation','date_at'));

        }
        elseif  ($request['ty_report']==2){
            $input = $request->all(); 
             $salesmans = User::where('role_id',2)->get();
            $date_at = $request['date_at'];
            $assiInformation = [];
            foreach ($salesmans as $salesman) {
                
               
                 $assistances = Attendance::where('salesman_id',$salesman->id)
                                ->where('datetimestart','LIKE', '%'.date_format(date_create($date_at),"Y-m-d").'%')
                                ->get();

                        if (count($assistances)==0){
                            array_push($assiInformation, array($salesman->name,$salesman->lastname,"-","-","No Asistió","No Asistió","Modulo"));
                        }else {
                            foreach ($assistances as $assistance){
                                $aux = ModuleAssigment::where('dateAssigments', '<' ,$date_at)->where('salesman_id',  $salesman->id)->get()->last();
                                
                                if (count($aux) == 0 ){
                                
                                    array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"-","-","No tiene Módulo"));
                                }
                                else {
                                    $module = Module::find($aux->module_id);
                                    $openHour = date_format(date_create($module->starTime),"H:i:s");
                                    
                                    if ($openHour >= date_format(date_create($assistance->datetimestart),"H:i:s")){
                                        if ($assistance->datetimeend == null){
                                            array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),"-","Llegó Puntual","Sigue Trabajando",$module->name));
                                        }
                                        else{


                                            $endHour = date_format(date_create($module->endTime),"H:i:s");
                                            if ($endHour <= date_format(date_create($assistance->datetimeend),"H:i:s")){
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llegó Puntual","Salio Puntual",$module->name));
                                            }
                                            else {
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llego Puntual","Salió Temprano",$module->name));
                                            }
                                        }
                                    }                  
                                    else{
                                        if ($assistance->datetimeend == null){
                                            array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),"-","Llegó Tarde","Sigue Trabajando",$module->name));
                                        }
                                        else {
                                             $endHour = date_format(date_create($module->endTime),"H:i:s");
                                            if ($endHour <= date_format(date_create($assistance->datetimeend),"H:i:s")){
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llegó Tarde","Salió Puntual",$module->name));
                                            }
                                            else {
                                                array_push($assiInformation, array($salesman->name,$salesman->lastname,date_format(date_create($assistance->datetimestart),"H:i:s"),date_format(date_create($assistance->datetimeend),"H:i:s"),"Llegó Tarde","Salió Temprano",$module->name));
                                            }
                                        }
                                    } 
                                }
                                
                            }
                        }
                        


                 //}

                 
             } 
            

            if ($input['type'] == 1){
                Excel::create('Reporte de asistencia de vendedores starkticket', function ($excel) use($assiInformation,$input){
                  $excel->sheet('Reporte de ventas', function($sheet) use($assiInformation,$input) {


                    $sheet->mergeCells('A1:G2');
                    $sheet->setCellValue('A1',"Reporte de asistencia de vendedores");
                    $sheet->cells('A1:G1',function($cells){

                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontSize(30);

                    });      


                    $sheet->mergeCells('A3:G3');
                    $sheet->setCellValue('A3','Fecha del '.$input['date_at']);
                    
                    $sheet->cells('A3:G3',function($cells){

                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontSize(14);

                    });      


                    $cantidad = count($assiInformation)+4;


                    $sheet->setBorder('A4:G' . $cantidad ,'thin');
                    $sheet->setCellValue('A4', "Nombres del Vendedor");
                    $sheet->setCellValue('B4', "Apellidos del Vendedor");
                    $sheet->setCellValue('C4', "Hora de Entrada");
                    $sheet->setCellValue('D4', "Hora de Salida");
                    $sheet->setCellValue('E4', "Situación de Entrada");
                    $sheet->setCellValue('F4', "Situación de Salida");
                    $sheet->setCellValue('G4', "Punto de Venta");
                    
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
                            'B' => '30',
                            'C' => '30',
                            'D' => '30',
                            'E' => '30',
                            'F' => '30',
                            'G' => '30'                                               

                            )

                        );

                    $sheet->setHeight(
                        array(   
                            '1' => '20'
                            )

                        );

                    $data = $assiInformation;
                    $sheet->fromArray($data, true, 'A5', true, false);

                  });
                })->download('xlsx');
            }
            else{
            Excel::create('Reporte de ventas starkticket', function ($excel) use($assiInformation,$input){
                  $excel->sheet('Reporte de ventas', function($sheet) use($assiInformation,$input) {


                    $sheet->mergeCells('A1:G2');
                    $sheet->setCellValue('A1',"Reporte de asistencia de vendedores");
                    $sheet->cells('A1:G1',function($cells){

                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontSize(30);

                    });      


                    $sheet->mergeCells('A3:G3');
                    $sheet->setCellValue('A3','Fecha del '.$input['date_at']);
                    
                    $sheet->cells('A3:G3',function($cells){

                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontSize(14);

                    });      


                    $cantidad = count($assiInformation)+4;


                    $sheet->setBorder('A4:G' . $cantidad ,'thin');
                    $sheet->setCellValue('A4', "Nombres del Vendedor");
                    $sheet->setCellValue('B4', "Apellidos del Vendedor");
                    $sheet->setCellValue('C4', "Hora de Entrada");
                    $sheet->setCellValue('D4', "Hora de Salida");
                    $sheet->setCellValue('E4', "Situación de Entrada");
                    $sheet->setCellValue('F4', "Situación de Salida");
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
                            'B' => '30',
                            'C' => '30',
                            'D' => '30',
                            'E' => '30',
                            'F' => '30',
                            'G' => '15'                                               

                            )

                        );

                    $sheet->setHeight(
                        array(   
                            '1' => '20'
                            )

                        );

                    $data = $assiInformation;
                    $sheet->fromArray($data, true, 'A5', true, false);

                  });
                })->export('pdf');

            }

        }
        

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
