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
use App\Models\Presentation;

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
        if ($ticket->cancelled)
        {
            Session::flash('message', 'El ticket fue cancelado');
            Session::flash('alert-class','alert-danger');
            return redirect('salesman/devolutions');
        }

        $presentation = $ticket->presentation()->first();

        if (!$presentation->cancelled)
        {
            Session::flash('message', 'La presentación no fue cancelado');
            Session::flash('alert-class','alert-danger');
            return redirect('salesman/devolutions');
        }

        $cancelPresentation = CancelPresentation::where("presentation_id",$ticket->presentation_id)->first();

        if (!$cancelPresentation->authorized)
        {
            Session::flash('message', 'El ticket no esta autorizado para ser devuelto');
            Session::flash('alert-class','alert-danger');
            return redirect('salesman/devolutions');
        }
        $today = strtotime(date("Y-m-d"));
        $date_refund = strtotime($cancelPresentation->date_refund);
        $date_refund_last = $date_refund + ($cancelPresentation->duration *  86400);
        if ($today < $date_refund)
        {
            Session::flash('message', 'El ticket aun no se puede devolver. Autorizado para devolución a partir de '.$cancelPresentation->date_refund);
            Session::flash('alert-class','alert-danger');
            return redirect('salesman/devolutions');
        }
        if ($today > $date_refund_last)
        {
            Session::flash('message', 'El ticket no puede ser devuelto, tiempo de devolución agotado');
            Session::flash('alert-class','alert-danger');
            return redirect('salesman/devolutions');
        }
        $modulesAuth = $cancelPresentation->modules;
        $userId = Auth::user()->id;
        $moduleUser = ModuleAssigment::where(["salesman_id"=>$userId,"status"=>1])->first();

        if (!is_object($moduleUser))
        {
            Session::flash('message', 'Usted no tiene modulo asignado, por lo tanto no puede devolver');
            Session::flash('alert-class','alert-danger');
            return redirect('salesman/devolutions');
        }

        $isAuthorized = 0;
        foreach ($modulesAuth as $obj)
        {
            if($obj->id == $moduleUser->module_id)
            {
                $isAuthorized = 1;
                break;
            }
        }
        return view('internal.salesman.devolution.new',["ticket"=>$ticket,"authorizedModule"=>$modulesAuth,"isAuthorized"=>$isAuthorized]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CancelledTicketRequest $request, $ticket_id)
    {
        $user_id = Auth::user()->id;

        $input = $request->all();
        if( $input['ticket_id'] != $ticket_id )
            return redirect('salesman/devolutions');

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
        if( isset($input['observation']))
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
