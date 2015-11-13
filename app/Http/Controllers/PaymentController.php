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
        $payments = Payment::all();
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
        $amountAccumulated = $event->amountAccumulated();
        $benefit = 5;
        $totalToPay = $amountAccumulated - $benefit;
        $paid = Payment::where("event_id",$event_id)->sum('paid');
        $debt = 0;
        if ($totalToPay > $paid)
            $debt = $totalToPay - $paid;
        $objs = array(
            "event"=>$event,
            "amountAccumulated"=>$amountAccumulated,
            "benefit"=>$benefit,
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

        $payment = new Payment;
        $payment->event_id = $event_id;
        $payment->promoter_id = $user_id;
        $payment->paid = $input['paid'];
        $payment->date_delivery = $input['dateDelivery'];
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
