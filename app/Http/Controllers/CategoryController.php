<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\FileService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource. (Internal)
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->file_service = new FileService();
    }
    public function index()
    {
        $categories = Category::where('type',1)->paginate(5);
        $subcat_list = [];
        foreach ($categories as $category) {
            $subcat_list[$category->name] = $this->getSubcategories($category->id);
        }
        return view('internal.admin.categories', ['categories' => $categories, 'subcategories' => $subcat_list]);
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
    public function indexSubAdmin($parent_category)
    {
        $categories = Category::where('father_id',$parent_category)->paginate(5);
        return view('internal.admin.subcategories', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_list = Category::where('type', '3')->lists('name','id');
        return view('internal.admin.newCategory',['categories_list' => $categories_list]);
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
            'image'         =>$this->file_service->upload($request->file('image'),'category')
            ];
        $category = new Category();
        foreach ($data as $key => $value) {
            $category->$key = $value;
        }
        $father_id = $request->input('father_id', '');
        if($father_id == ''){
            $category->type = 1;
            $category->father_id = null;
        } else {
            $category->type = 2;
            $parent = Category::find($father_id);
            $category->parentCategory()->associate($parent);
        }
        $category->save();
        return redirect()->route('admin.categories.index');
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
        $category =  Category::find($id);
        $categories_list = Category::where('type', '1')->lists('name','id');
        return view('internal.admin.editCategory', ['category' => $category, 'categories_list' => $categories_list]);
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
        ];
        $category = Category::find($id);
        foreach ($data as $key => $value) {
            if($value!='')
                $category->$key = $value;
        }
        if($request->file('image')!=null)
            $category->image = $this->file_service->upload($request->file('image'),'category');
        $father_id = $request->input('father_id', '');
        if($father_id != ''){
            $category->type = 2;
            $parent = Category::find($father_id);
            $category->parentCategory()->associate($parent);
        }
        $category->save();
        return redirect()->route('admin.categories.index');
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
        $subcategories = $this->getSubcategories($id)->toArray(); 
        if(!empty($subcategories)){
            $errors = [
                'The category has subcategories'
            ];
            return redirect()->back()->withErrors($errors);
        }
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
    public function getSubcategories($category_id){
        return Category::where('father_id', $category_id)->get();
    }
}
