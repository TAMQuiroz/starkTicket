<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Presentation;
use Excel;

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

                    $event= Event::where('id','=', $eventDate->event_id)->get(); 
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
                    $event =  Event::where('name', 'LIKE', '%'.$input['name'].'%')->where('id','=', $eventDate->event_id)->get(); 
                    
                    if ($event->count() != 0) {
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
                        array_push($eventInformation,array($event[0]->name, date("d/m/Y",$eventDate->starts_at) , $onlineTickets, $subTotalPresential,$presentialTicket, $subTotalOnline, $subTotalPresential + $subTotalOnline));
                    }
            }

        }
        else{
            foreach ($events as $event){
            // pueden ser muchos eventos. Necesito información para llenar la tabla
            //filtro fechas si es necesario
                 
                $eventsDate = Presentation::where('event_id','=', $event->id)->get(); 
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
                else $sheet->setCellValue('A3',"No hay rango de fechas");
                $sheet->cells('A3:G3',function($cells){

                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    $cells->setFontSize(14);

                });      
            



                $sheet->setBorder('A4:G500','thin');
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

                $sheet->cells('A4:G500',function($cells){

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
            $eventsDate = Presentation::where('event_id','=', $event->id)->get();
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
        return view('internal.admin.reports.assignment');
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
