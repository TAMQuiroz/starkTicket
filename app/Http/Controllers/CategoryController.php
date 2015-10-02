<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource. (Internal)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('internal.admin.categories');
    }

    /**
     * Display a listing of the resource. (External)
     *
     * @return \Illuminate\Http\Response
     */
    public function indexExternal()
    {
        return view('external.categories');
    }

    /**
     * Display a listing of the resource. (External)
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSub()
    {
        return view('external.subcategories');
    }

    /**
     * Display a listing of the resource. (External)
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSubAdmin()
    {
        return view('internal.admin.subcategories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.admin.newCategory');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showExternal($id)
    {
        return view('external.category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id, int $id2
     * @return \Illuminate\Http\Response
     */
    public function showSub($id, $id2)
    {
        return view('external.subcategory');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('internal.admin.editCategory');
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
