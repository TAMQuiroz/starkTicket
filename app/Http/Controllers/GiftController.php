<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Gift;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource (internal).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts = Gift::all();

        return view('internal.admin.gifts', compact('gifts'));
    }

    /**
     * Display a listing of the resource (external).
     *
     * @return \Illuminate\Http\Response
     */
    public function indexExternal()
    {
        return view('external.gifts');
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
        return view('internal.admin.exchangeGift');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExchange()
    {
        return view('internal.salesman.exchangeGift');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $gift               =   new Gift;
        $gift->name         =   $input['name'];
        $gift->description  =   $input['description'];
        $gift->points       =   $input['points'];
        $gift->stock        =   $input['stock'];      
        $gift->status       =   config('constants.available');
        //Control de subida de imagen
        $gift->image        =   'randomUrl';

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
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $gift = Gift::find($id);

        $gift->name         =   $input['name'];
        $gift->description  =   $input['description'];
        $gift->points       =   $input['points'];
        $gift->stock        =   $input['stock'];      
        $gift->status       =   config('constants.available');
        //Control de subida de imagen
        $gift->image        =   'randomUrl';

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
