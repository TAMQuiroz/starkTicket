<?php

namespace App\Http\Controllers;

use App\organizer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Organizer\StoreOrganizerRequest;
use App\Http\Requests\Organizer\UpdateOrganizerRequest;
use App\Http\Controllers\Controller;
use App\Services\FileService;

class OrganizerController extends Controller
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
        $organizador = organizer::paginate(2);
        $organizador->setPath('organizers');
        return view('internal.promoter.organizers', compact('organizador'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.promoter.newOrganizer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizerRequest $request)
    {
    
        $input = $request->all();

        $organizer               =   new organizer ;
        $organizer->organizerName         =   $input['organizerName'];
        $organizer->organizerLastName     =   $input['organizerLastName'];
        $organizer->businessName     =   $input['businessName'];
        $organizer->ruc      =   $input['ruc'];
        $organizer->countNumber           =   $input['countNumber'];
        $organizer->telephone      =   $input['telephone'];      
        $organizer->dni        =   $input['dni'];      
        $organizer->email        =   $input['email'];      
        $organizer->address        =   $input['address'];      
       
        if($request->file('image')!=null)
           $organizer->image        =   $this->file_service->upload($request->file('image'),'organizer'); 


        $organizer->save();
        
        return redirect('promoter/organizers');
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
        $organizador = organizer::find($id);
        return view('internal.promoter.editOrganizer', compact('organizador'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizerRequest $request, $id)
    {
        
        $input = $request->all();

        $organizer               =   organizer::find($id) ;
        $organizer->organizerName         =   $input['organizerName'];
        $organizer->organizerLastName     =   $input['organizerLastName'];
        $organizer->businessName     =   $input['businessName'];
        $organizer->ruc      =   $input['ruc'];
        $organizer->countNumber           =   $input['countNumber'];
        $organizer->telephone      =   $input['telephone'];      
        $organizer->dni        =   $input['dni'];      
        $organizer->email        =   $input['email'];      
        $organizer->address        =   $input['address'];      

   
        if($request->file('image')!=null)
           $organizer->image        =   $this->file_service->upload($request->file('image'),'organizer'); 



        $organizer->save();
        
        return redirect('promoter/organizers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organizer = organizer::find($id);
        $organizer->delete();
        return redirect('promoter/organizers');
    }
}
