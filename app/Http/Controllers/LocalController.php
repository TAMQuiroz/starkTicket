<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Local\StoreLocalRequest;
use App\Http\Requests\Local\UpdateLocalRequest;
use App\Models\Local;
use App\Services\FileService;

class LocalController extends Controller
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
        $locals = Local::paginate(2);
        $locals->setPath('local');
        return view('internal.admin.locals.locals',compact('locals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.admin.locals.newLocal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocalRequest $request)
    {
        //
        $input = $request->all();

        $local               =   new Local;
        $local->name         =   $input['name'];
        $local->capacity     =   $input['capacity'];
        $local->address      =   $input['address'];
        $local->district     =   $input['district'];
        $local->province     =   $input['province']; 
        $local->state        =   $input['state'];  
        $local->row          =   $input['row'];
        $local->column       =   $input['column'];

        
        //Control de subida de imagen
        $local->image        =   $this->file_service->upload($request->file('image'),'local');


        $local->save();
        return redirect('admin/local');
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
        $local = Local::find($id);
        return view('internal.admin.locals.editLocal',compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocalRequest $request, $id)
    {
        //
        $input = $request->all();

        $local = Local::find($id);

        
        $local->name         =   $input['name'];
        $local->capacity     =   $input['capacity'];
        $local->address      =   $input['address'];
        $local->district     =   $input['district'];
        $local->province     =   $input['province']; 
        $local->state        =   $input['state'];
        $local->row          =   $input['row'];     
        $local->column       =   $input['column'];            
        
        //Control de subida de imagen
        if($request->file('image')!=null)
            $local->image        =   $this->file_service->upload($request->file('image'),'local');


        $local->save();
        return redirect('admin/local');
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
        $local = Local::find($id);
        
        $local->delete();
        return redirect('admin/local');
    }
}
