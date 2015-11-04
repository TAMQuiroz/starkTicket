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

        $events = Event::all();
        $tickets = Ticket::all();
        $eventInformation = [];
                
        if (empty($input->name)){
            foreach ($events as $event){

            // pueden ser muchos eventos. Necesito información para llenar la tabla
                $eventsDate = Presentation::where('event_id','=', $event->id)->get();
                foreach ($eventsDate as $eventDate){
                    $tickets = Ticket::where('presentation_id','=', $eventDate->id)->get();
                    $onlineTickets = 0;  $presentialTicket = 0;
                    $subTotalOnline = 0; $subTotalPresential = 0;
                    foreach ($tickets as $ticket){
                        if (empty($ticket->salesman_id)) {
                            $onlineTickets = $onlineTickets + 1;
                            $subTotalPresential = $subTotalPresential + $ticket->price;
                        }
                        else {
                            $presentialTicket = $presentialTicket + 1;
                            $subTotalOnline = $subTotalOnline + $ticket->price;

                        }
                    }
                    array_push($eventInformation,array($event->name, date("d/m/Y",$eventDate->starts_at) , $onlineTickets, $subTotalPresential,$presentialTicket, $subTotalOnline, $subTotalPresential + $subTotalOnline));
                }

            }
        }
     //return $eventInformation;


        Excel::create('Probando archivo de Excel', function ($excel) use($eventInformation){
          $excel->sheet('Reporte de ventas', function($sheet) use($eventInformation) {

                //$sheet->mergeCells('A1:C1');

                $sheet->setBorder('A1:G1','thin');
                $sheet->setCellValue('A1', "Nombre del evento");
                $sheet->setCellValue('B1', "Fecha del evento");
                $sheet->setCellValue('C1', "Entradas vendidas online");
                $sheet->setCellValue('D1', "Subtotal");
                $sheet->setCellValue('E1', "Entradas vendidas módulo");
                $sheet->setCellValue('F1', "Subtotal");
                $sheet->setCellValue('G1', "Total");
                
                //$cells->setAlignment('center');
                $sheet->cells('A1:G1',function($cells){

                    $cells->setBackground('#000000');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });

                $sheet->cells('A1:G54',function($cells){

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
                $sheet->fromArray($data, null, 'A2', false, false);

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
                        $onlineTickets = $onlineTickets + 1;
                        $subTotalPresential = $subTotalPresential + $ticket->price;
                    }
                    else {
                        $presentialTicket = $presentialTicket + 1;
                        $subTotalOnline = $subTotalOnline + $ticket->price;

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
