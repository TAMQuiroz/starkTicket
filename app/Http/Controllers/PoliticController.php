<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Models\politics;
use App\Http\Requests\Politics\UpdatePoliticRequest;


class PoliticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('internal.promoter.politics');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        return view('internal.admin.politics.politics');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


   
   //     return redirect('politics');
        return view('internal.admin.politics.newPolitic');
    }

      public function politics()
    {
        $politics = politics::all();
  
        return view('internal.admin.politics.politics', compact('politics'));
    }



       public function politicsPromotor()
    {
        $politics = politics::all();
  
        return view('internal.promoter.politics', compact('politics'));
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

        $politics               =   new politics ;
        $politics->name         =   $input['name'];
        $politics->description  =   $input['description'];
         $politics->state =  $input['state'];; 
            /*
        $user->password     =   bcrypt($input['password']);
        $user->di_type      =   $input['di_type'];
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];      
        $user->phone        =   $input['phone'];      
        $user->email        =   $input['email'];      
        $user->birthday     =   new Carbon($input['birthday']);      
        $user->role_id      =   $input['role_id'];      
       /*
        if($request->file('image')!=null)
           $gift->image        =   $this->file_service->upload($request->file('image'),'gift'); */


        $politics->save();

return redirect('admin/politics');
      
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
        $politics = politics::find($id);

        return view('internal.admin.politics.editPolitic', compact('politics'));

      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePoliticRequest $request, $id)
    {
        
        $input = $request->all();

        $politics = politics::find($id);
        $politics->name         =   $input['name'];
        $politics->description     =   $input['description'];
        $politics->state     =   $input['state'];




        $politics->save();

        return redirect('admin/politics');
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
