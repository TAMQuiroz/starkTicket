<?php

namespace App\Http\Controllers;
use App\Http\Requests\Presentation\StorePresentationRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Presentation;
use App\Models\CancelPresentation;
use App\Models\Module;
use App\Models\ModulePresentationAuthorized;
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

            $cancelPresentation = CancelPresentation::where("presentation_id",$id)->first();

            return view('internal.promoter.presentation.editCancel', ['presentation' => $presentation,'cancelPresentation'=>$cancelPresentation]);
        }
        return view('internal.promoter.presentation.newCancel', ['presentation' => $presentation]);
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
    public function cancelUpdate(StorePresentationRequest $request,$id)
    {
        $user_id = Auth::user()->id;

        $input = $request->all();

        $cancel = CancelPresentation::findOrFail($id);
        $cancel->user_id = $user_id;
        $cancel->reason = $input['reason'];
        $cancel->duration = $input['duration'];
        $cancel->authorized = $input['authorized'];
        $cancel->date_refund = $input['date_refund'];
        $cancel->save();

        Session::flash('message', 'Información actualizada!');
        Session::flash('alert-class','alert-success');

        return redirect('/promoter/presentation/cancelled');
    }
    public function modules($presentationId)
    {
        $cancelled = CancelPresentation::findOrFail($presentationId);
        $modules = Module::all();
        $authorized = ModulePresentationAuthorized::where("cancelled_presentation_id",$presentationId)->get();
        return view('internal.promoter.presentation.authorized', ['cancelled' => $cancelled,"modules"=>$modules,"authorized"=>$authorized]);
    }
    public function modulesStorage(Request $request, $presentationCancelledID)
    {

        $input = $request->all();
        if (is_array($input["modules"]))
        {
            foreach ($input["modules"] as $module)
            {
                $mpa = ModulePresentationAuthorized::where(["cancelled_presentation_id" => $presentationCancelledID, "module_id" => $module])->get();

                if($mpa->isEmpty())
                {
                    $moduleAuthorized = new ModulePresentationAuthorized();
                    $moduleAuthorized->cancelled_presentation_id = $presentationCancelledID;
                    $moduleAuthorized->module_id = $module;
                    $moduleAuthorized->save();
                }
            }
            Session::flash('message', 'Modulos autorizados para devolución!');
            Session::flash('alert-class','alert-success');

            return redirect('/promoter/presentation/cancelled');
        } else {
            Session::flash('message', 'Elegir por lo menos un modulo');
            Session::flash('alert-class','alert-success');

            return redirect('/promoter/presentation/cancelled/'.$id.'/modules');

        }
    }
}
