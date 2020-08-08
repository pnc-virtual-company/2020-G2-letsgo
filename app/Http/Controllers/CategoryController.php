<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Category::class);
        $categories = Category::all();
        return view('manage.category.viewCategory',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $this->authorize('create', Category::class);
        $category = new Category;
        $request -> validate([
            'category' => 'required|unique:categories,category',
        ]);
        $category->category = $request->get('category');
        $category->save();
        return back();
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
        $this->authorize('update', Category::class);
        $request -> validate([
            'category' => 'required|unique:categories,category',
        ]);
        
        $category = Category::find($id);
        $category->category = $request->get('category');
        $category->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Category::class);
        $category = Category::find($id);
        $category->delete();
        return back();
    }

    public function existCategory(Request $request){
        $this->authorize('view', Category::class); 
        $existData = $request->get('value');
        if($request->ajax()){
            $value = DB::table('categories')->where('category', $existData)->get();
            return $value;
        }
    }

    public function updateExistCategory(Request $request){
        $this->authorize('view', Category::class); 
        $existData = $request->get('value');
        if($request->ajax()){
            $value = DB::table('categories')->where('category', $existData)->get();
            return $value;
        }
    }
}




