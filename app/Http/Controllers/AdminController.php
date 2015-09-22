<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
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

    public function createCategory()
    {
        return view('internal.admin.newCategory');
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
}
