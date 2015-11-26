<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Payment;
use Session;
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::where('promoter_id', Auth::user()->id)->get();
        return view('internal.promoter.payment.payments',["payments"=>$payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        $event = Event::findOrFail($event_id);
        if($event->cancelled)
        {
            Session::flash('message', 'Evento cancelado');
            Session::flash('alert-class','alert-warning');

            return redirect('promoter/event/record');
        }
        $amountAccumulated = $event->amountAccumulated();

        $amountComission = $amountAccumulated*$event->percentage_comission/100;
        $totalToPay = $amountAccumulated - $amountComission;
        $paid = Payment::where("event_id",$event_id)->sum('paid');
        $debt = 0;
        if ($totalToPay > $paid)
            $debt = $totalToPay - $paid;
        if($debt <= 0)
        {
            Session::flash('message', 'No se puede transferir, tiene deuda igual a cero');
            Session::flash('alert-class','alert-warning');

            return redirect('promoter/event/record');
        }
        $objs = array(
            "event"=>$event,
            "amountAccumulated"=>$amountAccumulated,
            "benefit"=>$amountComission,
            "totalToPay"=>$totalToPay,
            "paid"=>$paid,
            "debt"=>$debt,
            );
        return view('internal.promoter.payment.create',$objs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request,$event_id)
    {
        $user_id = Auth::user()->id;
        $input = $request->all();

        if($input['paid']>$input['debt'])
        {
            Session::flash('message', 'El monto excede el monto de la deuda');
            Session::flash('alert-class','alert-danger');
            return redirect('promoter/transfer_payments/'.$event_id.'/create');
        }

        $payment = new Payment;
        $payment->event_id = $event_id;
        $payment->promoter_id = $user_id;
        $payment->paid = $input['paid'];
        $payment->save();

        Session::flash('message', 'Pago a organizador realizado!');
        Session::flash('alert-class','alert-success');

        return redirect('/promoter/transfer_payments');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = Payment::findOrFail($id);
        return view('internal.promoter.payment.show', ['payment' => $obj]);
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
