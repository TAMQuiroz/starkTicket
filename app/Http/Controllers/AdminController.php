<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Gift;

class AdminController extends Controller
{
    public function client()
    {
        return view('internal.admin.client');
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

}
