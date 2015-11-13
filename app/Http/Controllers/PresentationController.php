<?php

namespace App\Http\Controllers;
use App\Http\Requests\Presentation\StorePresentationRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Presentation;
use App\Models\CancelPresentation;
use Auth;
use Session;

class PresentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presentationCancelled = CancelPresentation::all();
        return view('internal.promoter.presentation.cancelled',["presentationCancelled"=>$presentationCancelled]);
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

    public function cancel($id)
    {
        $presentation = Presentation::findOrFail($id);
        if ($presentation->cancelled == 1)
        {
            Session::flash('message', 'La presentación ya fue cancelado!');
            Session::flash('alert-class','alert-danger');

            return redirect('/promoter/event/record');
        }
        return view('internal.promoter.presentation.cancel', ['presentation' => $presentation]);
    }
    public function cancelStorage(StorePresentationRequest $request, $presentation_id)
    {
        $user_id = Auth::user()->id;

        $input = $request->all();

        $presentation = Presentation::findOrFail($presentation_id);
        $presentation->cancelled = "1";
        $presentation->save();

        $cancel = new CancelPresentation;
        $cancel->presentation_id = $presentation_id;
        $cancel->user_id = $user_id;
        $cancel->reason = $input['reason'];
        $cancel->duration = $input['duration'];
        $cancel->authorized = $input['authorized'];
        $cancel->date_refund = $input['date_refund'];
        $cancel->save();

        Session::flash('message', 'La presentación se a cancelado!');
        Session::flash('alert-class','alert-success');

        return redirect('/promoter/presentation/cancelled');
    }
}
