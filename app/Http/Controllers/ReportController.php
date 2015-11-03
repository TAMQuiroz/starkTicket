<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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

    public function actionExcel(){

        Excel::create('Probando archivo de Excel', function ($excel){

          $excel->sheet('Sheetname', function($sheet){

                $sheet->mergeCells('A1:C1');

                $sheet->setBorder('A1:F1','thin');

                $sheet->cells('A1:F1',function($cells){

                    $cells->setBackground('#000000');
                    $cells->setFontColor('#FFFFFF');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');

                });

                $sheet->setWidth(
                    array(
                        'D' => '50'
                    )

                );


                $sheet->setHeight(
                    array(   
                        '1' => '20'
                    )

                );

                $data = [];
                array_push($data,array('Gerardo',  '',  '',  'Davila', 'Garcia', 'Paolo'));
                array_push($data,array('Timoteo',  '',  '',  'Sexy', 'Sensual', 'Hermoso'));
                array_push($data,array('Matias',  '',  '',  'Gato', 'Grande', 'Gordo'));


                $sheet->fromArray($data, null, 'A1', false, false);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSales()
    {
        return view('internal.admin.reports.sales');
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
