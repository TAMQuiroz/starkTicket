<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Session;
use Auth;
use App\Models\Devolution;

class DevolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devolutions = Devolution::all();
        return view('internal.admin.devolution.listar', ['devolutions' => $devolutions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.admin.devolution.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $input = $request->all();

        $ticket = Ticket::findOrFail($input['ticket_id']);
        $devolution = new Devolution;
        $devolution->ticket_id = $input['ticket_id'];
        $devolution->client_id = $ticket->owner_id;
        $devolution->user_id = $user_id;
        $devolution->price = $ticket->price;
        $devolution->repayment = $input['repayment'];
        $devolution->observation = $input['observation'];
        $devolution->save();

        Session::flash('message', 'Devolution realizado!');
        Session::flash('alert-class','alert-success');

        return redirect('/admin/devolutions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $devolution = Devolution::findOrFail();
        return view('internal.admin.devolution.show', ['devolution' => $devolution]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
