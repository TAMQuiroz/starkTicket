<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Ticket\CancelledTicketRequest;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Session;
use Auth;
use App\Models\Devolution;
use App\Models\CancelPresentation;
use App\Models\ModuleAssigment;

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
        return view('internal.salesman.devolution.listar', ['devolutions' => $devolutions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);
        $presentation = CancelPresentation::find($ticket->presentation_id);
        $authorized = $presentation->modules();

        $userId = Auth::user()->id;
        $modules = ModuleAssigment::where(["salesman_id"=>$userId,"status"=>1])->get();
        $authorized = 1;

        print_r($modules);
        //Verificar si esta authorizado

        //return view('internal.salesman.devolution.new',["ticket"=>$ticket,"authorized"=>$authorized]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CancelledTicketRequest $request)
    {
        $user_id = Auth::user()->id;

        $input = $request->all();

        $ticket = Ticket::findOrFail($input['ticket_id']);
        if ($ticket->cancelled == 1)
        {
            Session::flash('message', 'El ticket ya fue cancelado!');
            Session::flash('alert-class','alert-danger');

            return redirect('salesman/devolutions');
        }
        if ($ticket->presentation["cancelled"] == 0)
        {
            Session::flash('message', 'La presentation '.$ticket->presentation_id.' no fue cancelado, por lo tanto no se puede realizar devolución');
            Session::flash('alert-class','alert-danger');

            return redirect('/salesman/devolutions');
        }
        $ticket->cancelled = 1;
        $ticket->save();

        $devolution = new Devolution;
        $devolution->ticket_id = $input['ticket_id'];
        $devolution->user_id = $user_id;
        $devolution->repayment = $input['repayment'];
        $devolution->observation = $input['observation'];
        $devolution->save();

        Session::flash('message', 'Devolución realizado!');
        Session::flash('alert-class','alert-success');

        return redirect('/salesman/devolutions');
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
        return view('internal.salesman.devolution.show', ['devolution' => $devolution]);
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
