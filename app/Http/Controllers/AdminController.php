<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Gift;

class AdminController extends Controller
{
    public function home()
    {
        return view('internal.admin.home');
    }

    public function exchangeRate()
    {
        return view('internal.admin.exchangeRate');
    }

    public function about()
    {
        return view('internal.admin.about');
    }

    public function system()
    {
        return view('internal.admin.system');
    }

    public function ticketReturn()
    {
        return view('internal.admin.ticketReturn');
    }

    public function newTicketReturn()
    {
        return view('internal.admin.newTicketReturn');
    }

    public function reportList()
    {
        return view('internal.admin.reportList');
    }

    public function report($id)
    {
        return view('internal.admin.report');
    }
    public function reportSales()
    {
        return view('internal.admin.reports.sales');
    }
    public function reportAssistance()
    {
        return view('internal.admin.reports.assistance');
    }
    public function reportAssignment()
    {
        return view('internal.admin.reports.assignment');
    }

    public function newCategory()
    {
        return view('internal.admin.newCategory');
    }

    public function editCategory()
    {
        return view('internal.admin.editCategory');
    }

    public function categoryList()
    {
        return view('internal.admin.categories');
    }

    public function attendance()
    {
        return view('internal.admin.attendance');
    }

    public function modules()
    {
        return view('internal.admin.module');
    }

    public function newModule()
    {
        return view('internal.admin.newModule');
    }

    public function editModule($id)
    {
        return view('internal.admin.editModule');
    }

    public function exchangeGift()
    {
        return view('internal.admin.exchangeGift');
    }

    public function gifts()
    {

        $gifts = Gift::all();

        return view('internal.admin.gifts', compact('gifts'));
    }

    public function newGift()
    {
        return view('internal.admin.newGift');
    }

    public function newGiftPost(Request $request)
    {
        $input = $request->all();

        $gift               =   new Gift;
        $gift->name         =   $input['name'];
        $gift->description  =   $input['description'];
        $gift->points       =   $input['points'];
        $gift->stock        =   $input['stock'];      
        $gift->status       =   config('constants.available');
        //Control de subida de imagen
        $gift->image        =   'randomUrl';

        $gift->save();
        
        return redirect('admin/gifts');
    }

    public function editGift($id)
    {
        $gift = Gift::find($id);

        return view('internal.admin.editGift', compact('gift'));
    }

    public function editGiftPost(Request $request, $id)
    {
        $input = $request->all();

        $gift = Gift::find($id);

        $gift->name         =   $input['name'];
        $gift->description  =   $input['description'];
        $gift->points       =   $input['points'];
        $gift->stock        =   $input['stock'];      
        $gift->status       =   config('constants.available');
        //Control de subida de imagen
        $gift->image        =   'randomUrl';

        $gift->save();        

        return redirect('admin/gifts');
    }

    public function deleteGift($id)
    {
        $gift = Gift::find($id);
        
        $gift->delete();
        return redirect('admin/gifts');
    }

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
        return view('internal.admin.admin');
    }

    public function editAdmin($id)
    {
        return view('internal.admin.editAdmin');
    }

    public function newUser()
    {
        return view('internal.admin.newUser');
    }

    public function politics()
    {
        return view('internal.admin.politics.politics');
    }

    public function newPolitic()
    {
        return view('internal.admin.politics.newPolitic');
    }

    public function editPolitic($id)
    {
        return view('internal.admin.politics.editPolitic');
    }

}
