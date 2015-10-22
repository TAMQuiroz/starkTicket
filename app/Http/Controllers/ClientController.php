<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Session;
use Carbon\Carbon;
use App\Services\FileService;

class ClientController extends Controller
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
        $clients = User::where('role_id','1')->paginate(10);
        return view('internal.admin.client.clients', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function desactive(Request $request)
    {
        $input = $request->all();
        if(isset($input['client_id']))
        {
            $user = User::findOrFail($input['client_id']);
            $user->delete();

            Session::flash('message', 'Client deleted');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Client not found!');
            Session::flash('alert-class','alert-danger');
        }

        return redirect('/admin/client');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:3|max:16',
            'lastname' => 'required|min:3|max:16',
            'password' => 'required|min:8|max:16',
            'di_type' => 'required|digits_between:0,2',
            'di' => 'required|min:8|max:16',
            'email' => 'required|min:12|max:32',
            'birthday' => 'required|date'
        ]);

        $input = $request->all();

        $user = new User ;
        $user->name = $input['name'];
        $user->lastName = $input['lastname'];
        $user->password = bcrypt($input['password']);
        $user->di_type = $input['di_type'];
        $user->di = $input['di'];
        $user->address = $input['address'];
        $user->phone = $input['phone'];
        $user->email = $input['email'];
        $user->birthday = new Carbon($input['birthday']);
        $user->role_id = 1;
        $user->save();

        Session::flash('message', 'Client created!');
        Session::flash('alert-class','alert-success');

        return redirect('/');
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
    public function edit()
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        return view('internal.client.edit', ['obj' => $obj]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|min:3|max:16',
            'lastname' => 'required|min:3|max:16',
            'di_type' => 'required|digits_between:0,2',
            'di' => 'required|min:8|max:16',
            'email' => 'required|min:12|max:32',
            'birthday' => 'required|date'
        ]);

        $input = $request->all();

        $obj->fill($input)->save();

        Session::flash('message', 'Profile information successfully updated!');
        Session::flash('alert-class','alert-success');
        return redirect('client');
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

    /**
     * Client profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        return view('internal.client.profile', ['obj' => $obj]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('internal.client.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);

        $this->validate($request, [
            'password' => 'required|min:8|max:16',
            'new_password' => 'required|confirmed|min:8|max:16'
        ]);

        $auth = Auth::attempt( array(
            'email' => $obj->email,
            'password' => $request->input('password')
            ));

        if ($auth)
        {
            $newPassword = bcrypt($request->input('new_password'));
            $obj->password = $newPassword;
            $obj->save();

            Session::flash('message', 'Your password updated!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Password!');
            Session::flash('alert-class','alert-danger');
        }

        return redirect('client');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photoEdit()
    {
        return view('internal.client.photo');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photoUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);

        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $obj->image = $this->file_service->upload($request->file('image'),'client');
        $obj->save();

        Session::flash('message', 'Your image updated!');
        Session::flash('alert-class','alert-success');

        return redirect('client');
    }
}
