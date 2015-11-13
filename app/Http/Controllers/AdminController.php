<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreAdminRequest;
use App\Http\Requests\User\UpdateAdminRequest;
use App\user;
use Carbon\Carbon;
use App\Services\FileService;
use App\Models\ModuleAssigment;


class AdminController extends Controller
{
    public function __construct(){
        $this->file_service = new FileService();
    }

    public function client()
    {
        return view('internal.admin.client');
    }
    public function salesman()
    {

        $vendedores = User::where('role_id',2)->paginate(5);
        $vendedores->setPath('salesman');

        return view('internal.admin.salesman',compact('vendedores'));
    }

    public function editSalesman($id)
    {
        $user = User::find($id);
        return view('internal.admin.editSalesman',compact('user'));
    }


    public function updateSalesman(UpdateAdminRequest $request, $id)
    {

        $input = $request->all();

        $user = User::find($id);
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];

        if ($input['password'] != null )
            $user->password     =   bcrypt($input['password']);

        $user->di_type      =   $input['di_type'];
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];
        $user->birthday     =   new Carbon($input['birthday']);
        $user->role_id      =   $input['role_id'];

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }
        /*
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');
        */
        $user->save();

        return redirect('admin/salesman');
    }

    public function promoter()
    {
        $promoters = User::where('role_id',3)->paginate(5);
        $promoters->setPath('promoter');
        return view('internal.admin.promoter', compact('promoters'));
    }

    public function editPromoter($id)
    {

        $user = User::find($id);
        return view('internal.admin.editPromoter',compact('user'));
    }

    public function updatePromoter(UpdateAdminRequest $request, $id)
    {

        $input = $request->all();

        $user = User::find($id);
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];

        if ($input['password'] != null )
            $user->password     =   bcrypt($input['password']);

        $user->di_type      =   $input['di_type'];
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];
        $user->birthday     =   new Carbon($input['birthday']);
        $user->role_id      =   $input['role_id'];

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }
        /*
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');
        */
        $user->save();

        return redirect('admin/promoter');
    }

    public function admin()
    {
        $users = User::where('role_id',4)->paginate(5);
        $users->setPath('admin');
        return view('internal.admin.admin', compact('users'));
    }

    public function editAdmin($id)
    {
        $user = User::find($id);

        return view('internal.admin.editAdmin', compact('user'));
    }

    public function updateAdmin(UpdateAdminRequest $request, $id)
    {
        $input = $request->all();

        $user = User::find($id);
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];

        if ($input['password'] != null )
            $user->password     =   bcrypt($input['password']);

        $user->di_type      =   $input['di_type'];
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];
        $user->birthday     =   new Carbon($input['birthday']);
        $user->role_id      =   $input['role_id'];

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }
        /*
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');
        */
        $user->save();

        return redirect('admin/admin');
    }

    public function newUser()
    {
        return view('internal.admin.newUser');

    }


    public function store(StoreAdminRequest $request)
    {
        $input = $request->all();

        $user               =   new User ;
        $user->name         =   $input['name'];
        $user->lastName     =   $input['lastname'];
        $user->password     =   bcrypt($input['password']);
        $user->di_type      =   $input['di_type'];
        $user->di           =   $input['di'];
        $user->address      =   $input['address'];
        $user->phone        =   $input['phone'];
        $user->email        =   $input['email'];

        $user->birthday     =   new Carbon($input['birthday']);


        $user->role_id      =   $input['role_id'];
        if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user');

        // validate la edad del usuario 

        $birthday =  new \DateTime ($input['birthday']);
        $currentDate = new \DateTime('now');
        $interval = $birthday->diff($currentDate);
        if($interval->format('%y') < 18){ 
            //return back()->withInput($request->except('seats'))->withErrors(['El asiento '. $seat_id.' no esta libre']);
            return back()->withErrors(['El usuario debe tener más de 18 años']);
        }

        $user->save();

        if($user->role_id == '4')
             return redirect('admin/admin');
        elseif ($user->role_id == '3')
            return redirect('admin/promoter');
        else
            return redirect('admin/salesman');

    }

        public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/admin');

   }

    public function destroyPromoter($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/promoter');
    }

    public function destroySalesman($id)
    {
        $moduleassigment = ModuleAssigment::where('salesman_id',$id)->where('status',1)->get();

        if ($moduleassigment->count()==0){
            $user = User::find($id);
            $user->delete();

        }else{
            return back()->withErrors(['Debe primero desasociar el vendedor del punto de venta']);
        }

        return redirect('admin/salesman');
    }

}
    