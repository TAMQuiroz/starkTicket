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


class AdminController extends Controller
{
    public function salesman()
    {
        return view('internal.admin.salesman');
    }

    public function editSalesman($id)
    {
        return view('internal.admin.editSalesman');
    }

    public function promoter()
    {
        return view('internal.admin.promoter');
    }

    public function editPromoter($id)
    {
        return view('internal.admin.editPromoter');
    }

    public function admin()
    {
        $users = User::where('role_id',4)->paginate(2);
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
       /* if($request->file('image')!=null)
           $user->image        =   $this->file_service->upload($request->file('image'),'user'); */

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
       /*
        if($request->file('image')!=null)
           $gift->image        =   $this->file_service->upload($request->file('image'),'gift'); */


        $user->save();

        return redirect('admin');
    }

        public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('admin/admin');
    }

}
