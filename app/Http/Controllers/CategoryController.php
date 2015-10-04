<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource. (Internal)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('internal.admin.categories', ['categories' => $categories]);
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
    public function store(StoreCategoryRequest $request)
    {
        $data = [
            'name'          =>$request->input('name'),
            'description'   =>$request->input('description'),
            'image'         =>$request->input('image_file'),
        ];
        $category = new Category();
        foreach ($data as $key => $value) {
            $category->$key = $value;
        }
        $father_id = $request->input('father_id', '');
        if($father_id == ''){
            $category->type = 1;
            $category->father_id = null;
            $category->save();
        } else {
            $category->type = 2;
            $parent = Category::find($father_id);
            $category->parentCategory()->associate($parent);
            $category->save();
            $parent->subcategories()->associate($category);
            $parent->save();
        }
        return redirect()->route('internal.admin.categories');
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
    public function update(UpdateCategoryRequest $request, $id)
    {
        $data = [
            'name'          =>$request->input('name',''),
            'description'   =>$request->input('description',''),
            'image'         =>$request->input('image_file','')
        ];
        $category = Category::find($id);
        foreach ($data as $key => $value) {
            if($value!='')
                $category->$key = $value;
        }
        $category->save();
        return redirect()->route('internal.admin.categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('internal.admin.categories');
    }
}
