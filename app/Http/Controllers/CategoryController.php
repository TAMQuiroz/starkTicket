<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('external.categories');
    }

    public function show($id)
    {
        return view('external.category');
    }

    public function indexSub()
    {
        return view('external.subcategories');
    }

    public function showSub($id, $id2)
    {
    	
        return view('external.subcategory');
    }

}
