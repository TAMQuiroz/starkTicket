<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gift\StoreGiftRequest;
use App\Http\Requests\Gift\UpdateGiftRequest;
use App\Http\Requests\Gift\exchangeGift;
use App\Models\Gift;
use App\Services\FileService;
use App\User;


class GiftController extends Controller
{   

    public function __construct(){
        $this->file_service = new FileService();
    }
    /**
     * Display a listing of the resource (internal).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts = Gift::paginate(2);
        $gifts->setPath('gifts');
        return view('internal.admin.gifts', compact('gifts'));
    }

    /**
     * Display a listing of the resource (external).
     *
     * @return \Illuminate\Http\Response
     */
    public function indexExternal()
    {
        $gifts = Gift::all();
        return view('external.gifts', compact('gifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.admin.newGift');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExchangeAdmin()
    {
        $gifts = Gift::all();
        return view('internal.admin.exchangeGift', compact('gifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExchange()
    {


    $giftsArr = Gift::all();
    $giftsList = Gift::orderBy('id')->get()->lists('name','id') ;
     $min = Gift::orderBy('id')->get()->lists('id')->first();


   
    return view('internal.salesman.exchangeGift', ['giftsList' => $giftsList , 'giftArray' => $giftsArr , 'min'=>   $min ]  );


    }

    public function createExchangePost(exchangeGift $request)
    {
            $input = $request->all();
        $idGift               =  $input['gifts'];
        $idClient  =  $input['nombre_de_usuario'];




        $gift = Gift::find($idGift);
        $user = User::find($idClient);


   if(  $gift->points >  $user->points )

            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario no posee puntos suficientes.']);
    elseif(    $gift->stock   ==  0  )

            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El juguete seleccionado se encuentra agotado.']);
    
  




  $gift->stock        =    $gift->stock -1 ; 
  $gift->save();

  $user->points =   $user->points  - $gift->points      ;  
  $user->save();

    $giftsArr = Gift::all();
    $giftsList = Gift::orderBy('id')->get()->lists('name','id') ;



   
 return view('internal.salesman.exchangeGift', ['giftsList' => $giftsList , 'giftArray' => $giftsArr]  );


    //  return redirect('salesman');



    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGiftRequest $request)
    {
        $input = $request->all();

        $gift               =   new Gift;
        $gift->name         =   $input['name'];
        $gift->description  =   $input['description'];
        $gift->points       =   $input['points'];
        $gift->stock        =   $input['stock'];
        if($gift->stock > 0)    
            $gift->status   =   config('constants.gift_available');
        elseif($gift->stock == 0)
            $gift->status   =   config('constants.gift_soldOut');   
        //Control de subida de imagen por hacer
        $gift->image        =   $this->file_service->upload($request->file('image'),'gift');

        $gift->save();
        
        return redirect('admin/gifts');
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
        $gift = Gift::find($id);

        return view('internal.admin.editGift', compact('gift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGiftRequest $request, $id)
    {
        $input = $request->all();

        $gift = Gift::find($id);

        $gift->name         =   $input['name'];
        $gift->description  =   $input['description'];
        $gift->points       =   $input['points'];
        $gift->stock        =   $input['stock'];
        if($gift->stock > 0)    
            $gift->status   =   config('constants.gift_available');
        elseif($gift->stock == 0)
            $gift->status   =   config('constants.gift_soldOut');
        //Control de subida de imagen
        if($request->file('image')!=null)
            $gift->image        =   $this->file_service->upload($request->file('image'),'gift');

        $gift->save();        

        return redirect('admin/gifts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gift = Gift::find($id);
        $gift->delete();
        return redirect('admin/gifts');
    }
}
