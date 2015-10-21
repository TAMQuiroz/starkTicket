<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
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
            'name' => 'required',
            'lastname' => 'required'
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
            'password' => 'required',
            'new_password' => 'required|confirmed'
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
}
