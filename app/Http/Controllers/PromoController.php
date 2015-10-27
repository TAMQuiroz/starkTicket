<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Promotions;
use App\Models\Event;

use App\Models\Category;

use App\Http\Requests\Promotions\StorePromotionRequest;



class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('internal.promoter.promotions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {

        $input = $request->all();

        $promotions               =   new Promotions ;
        $promotions->name         =   $input['promotionName'];
        $promotions->description  =   $input['description'];
        $promotions->startday  =   $input['dateIni'];

        $aux = $input['dateIni']. ' '. $input['timeIni'];
        $promotions->startday  =    $aux;

        $aux =   $input['dateEnd']     .' '. $input['timeEnd'];
        $promotions->endday =   $aux  ; 
        


        $promotions->desc  =   $input['discount'];
        $promotions->event_id  = $input['evento'] ;

      //  $promotions->user_id  = 3  ;

        $promotions->save();

        return redirect('promoter/promotion');
      
      //  return $input['select'] ;

       
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function create()
    {

          $events = Event::all();






        return view('internal.promoter.newPromotion', compact('events'));
    }


  
    public function promotion()
    {

          $promotions = Promotions::all();






        return view('internal.promoter.promotions', compact('promotions'));
    }


 



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
        return view('internal.promoter.editPromotion');
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
