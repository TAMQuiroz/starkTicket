<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Module\StoreModuleRequest;
use App\Http\Requests\Module\UpdateModuleRequest;
use App\Models\Module;
use App\Models\ModuleAssigment;
use Carbon\Carbon;
use App\Services\FileService;
use DB;
use App\User;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource. (Internal)
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->file_service = new FileService();
    }
    public function index()

    {
        
        $modules = Module::paginate(5);
        $modules->setPath('modules');
        return view('internal.admin.module', compact('modules'));
    }

    /**
     * Display a listing of the resource (External)
     * 
     * @return \Illuminate\Http\Response
     */
    public function indexExternal()
    {
        $modules = Module::all();
        return view('external.modules',compact('modules'));
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
    public function store(StoreModuleRequest $request)
    {
        //
        $input = $request->all();

        $module               =   new Module;
        $module->name         =   $input['name'];
        $module->address      =   $input['address'];
        $module->district     =   $input['district'];
        $module->province     =   $input['province']; 
        $module->state        =   $input['state'];    
        $module->phone        =   $input['phone'];
        $module->email        =   $input['email'];
        $module->initial_cash =   0;   
        $module->actual_cash  =   0; 
        $module->openModule   =   false;  
        $module->starTime     =   new Carbon($input['starTime']); 
        $module->endTime      =   new Carbon($input['endTime']);       
        
        //Control de subida de imagen
        $module->image        =   $this->file_service->upload($request->file('image'),'module');


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
    public function update(UpdateModuleRequest $request, $id)
    {
        //
        $input = $request->all();

        $module = Module::find($id);

        $module->name         =   $input['name'];
        $module->address      =   $input['address'];
        $module->district     =   $input['district'];
        $module->province     =   $input['province'];      
        $module->state        =   $input['state'];  
        $module->phone        =   $input['phone'];   
        $module->email        =   $input['email']; 
        $module->starTime     =   new Carbon($input['starTime']); 
        $module->endTime      =   new Carbon($input['endTime']);      
        
        //Control de subida de imagen
        if($request->file('image')!=null)
            $module->image        =   $this->file_service->upload($request->file('image'),'module');

        $module->save();        

        return redirect('admin/modules');
    }
    public function showAssigment()
    {
        //
        $assigmentmodules = DB::table('module_assigments')
                    ->select(DB::raw('module_assigments.id as idAssigment, module_assigments.module_id as idModule, modules.name as nameModule, module_assigments.salesman_id as idSalesman, users.name as nameSalesman, users.lastName as lastnameSalesman, module_assigments.dateAssigments as dateAssigment'))
                    ->where('module_assigments.status','=',1)
                    ->leftJoin('modules', 'modules.id', '=', 'module_assigments.module_id')
                    ->leftJoin('users', 'users.id', '=', 'module_assigments.salesman_id')
                    ->get();
                    //->lists('modules.name as name','modules.id as id');
        
      /* $modules_list = DB::table('modules')
                    //->select(DB::raw('modules.name as name, modules.id as id'))
                    //->where('module_assigments.status','=',2)
                    //-> where('module_assigments.status','is',null)
                    //->leftJoin('module_assigments', 'modules.id', '=', 'module_assigments.module_id')
                    //->get();
                    //->lists('modules.name as name','modules.id as id');*/
                   


        /*$salesmans_list =  DB::table('users')
                    ->select(DB::raw('users.name as name, users.id as id'))
                   // ->where('module_assigments.status','=',2) 
                    -> where('module_assigments.status','is',null)-> where('Susers.role_id','=',2)
                    ->leftJoin('module_assigments', 'users.id', '=', 'module_assigments.salesman_id')
                    ->get();
                    //->lists('users.name as name','users.id as id');*/

        $modEx = DB::table('module_assigments')->where('status','=',1)->get();
        $modules_list = Module::all()/*DB::table('modules')*//*->where('id',2'NOT IN',DB::raw(' ( select module_id from module_assigments where status = 1)' ))*/->lists('name','id');
        $salesmans_list = User::all()->where('role_id',2)->where('module_id',null)->lists('di','id','name','lastname');
        //$modules_list = [];
        //$salesmans_list = [];
        /*foreach ($modules as $module) {
            array_push($modules_list,array($module->name, $module->id));
        }
        foreach ($salesmans as $salesman) {
            array_push($salesmans_list,array($salesmans->name + ' ' + $salesmans->lastName, $salesman->id));
        }*/


        $array = ['modules_list' =>$modules_list,
        'salesmans_list'   =>$salesmans_list];

        //$assigmentmodule->setPath('modules');
        return view('internal.admin.moduleassigment', compact('assigmentmodules','modEx'/*,'modules_list','salesmans_list'*/),$array);

    }
    public function newAssigment(request $request)
    {
        
       // $modules = Module::where('id',\Auth::user()->id_module)->get();

       // $module = Module::find($request['module_id']);
       // $module->salesman_id  = $request['salesman_id'];
       // $module->save();

        $moduleAssiPass = ModuleAssigment::where('module_id',$request['module_id'])->where('status',1)->get();

        if ($moduleAssiPass->count()==0){
            $salesman = User::find($request['salesman_id']);
            if ($salesman->module_id!=null){
                 return back()->withErrors(['Este vendedor ya ha sido asignado']);    
            }
            $salesman->module_id   = $request['module_id'];
            $salesman->save();

            $moduleassigment                 =   new ModuleAssigment;
            $moduleassigment->module_id      =   $request['module_id'];
            $moduleassigment->salesman_id    =   $request['salesman_id'];
            $moduleassigment->status         =   1;
            $moduleassigment->dateAssigments =   new Carbon(); 
          

            $moduleassigment->save();

        }else{
            return back()->withErrors(['Ese modulo de trabajo ya ha sido asignado']);
        }
     
         return redirect('admin/modules/assigment');
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
        $moduleassigment = ModuleAssigment::where('module_id',$id)->where('status',1)->get();

        if ($moduleassigment->count()==0){
            $module = Module::find($id);
            $module->delete();

        }else{
            return back()->withErrors(['Debe primero desasociar el vendedor del punto de venta']);
        }

        return redirect('admin/modules');
    }
    public function destroyAssigment($id)
    {
        //
        $moduleassigment = ModuleAssigment::find($id);

        $salesman = User::find($moduleassigment->salesman_id);
        $tickets = DB::table('tickets')
                    ->where('salesman_id','=',$salesman->id)
                    ->where('payment_date','<',new Carbon())->where('payment_date','>=',Carbon::today())
                    ->whereNull('cashCount_register')
                    ->get();

        $devolutions = DB::table('devolutions')
                    ->where('tickets.salesman_id','=',$salesman->id)
                    ->where('devolutions.created_at','<',new Carbon())->where('devolutions.created_at','>=',Carbon::today())
                    ->whereNull('devolutions.cashCount_register')
                    ->leftJoin('tickets', 'tickets.id', '=', 'devolutions.ticket_id')
                    ->get();

        if ($tickets != null ){
            return back()->withErrors(['Antes de desasociar, primero debes hacer el arqueo de caja']); 
            
        }
        if ($devolutions != null){
            return back()->withErrors(['Antes de desasociar, primero debes hacer el arqueo de caja']); 
        }


        $moduleassigment->status = 2;
        $moduleassigment->dateMoveAssigments = new Carbon();

        $salesman = User::find($moduleassigment->salesman_id);
        $salesman->module_id  = null;

        $salesman->save();
        $moduleassigment->save();

        return redirect('admin/modules/assigment');
    }
}
