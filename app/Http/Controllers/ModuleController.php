<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource. (Internal)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        
        $modules = Module::all();
        return view('internal.admin.module', ['modules' => $modules]);
    }

    /**
     * Display a listing of the resource (External)
     * 
     * @return \Illuminate\Http\Response
     */
    public function indexExternal()
    {
        return view('external.modules');
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.admin.newModule');
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
        $input = $request->all();

        $module               =   new Module;
        $module->name         =   $input['name'];
        $module->address      =   $input['address'];
        $module->district     =   $input['district'];
        $module->province     =   $input['province']; 
        $module->state        =   $input['state'];       
        $module->status       =   config('constants.available');
        //Control de subida de imagen
        $module->image        =   'randomUrl';

        $module->save();
        
        return redirect('admin/modules');
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
        $module = Module::find($id);
        return view('internal.admin.editModule',compact('module'));
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
        $input = $request->all();

        $module = Module::find($id);

        $module->name         =   $input['name'];
        $module->address      =   $input['address'];
        $module->district     =   $input['district'];
        $module->province     =   $input['province'];      
        $module->state        =   $input['state'];      
        $module->status       =   config('constants.available');
        //Control de subida de imagen
        $module->image        =   'randomUrl';

        $module->save();        

        return redirect('admin/modules');
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
        $module = Module::find($id);
        
        $module->delete();
        return redirect('admin/modules');
    }
}
