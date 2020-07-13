<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Category::class); 
        return view('manage.category.viewCategory');
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
        $this->authorize('update', Category::class);
        $request -> validate([
            'category' => 'required|',
        ]);
        
        $category = Category::find($id);
        $category->category = $request->get('category');
        $category->save();
        return back();
        // dd($category);
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
    public function search(Request $request){
        $this->authorize('view', Category::class); 
        $dataSearch = $request->get('query');
        if($request->ajax()){
            $query = DB::table('categories')->where('category', 'LIKE', '%' . $dataSearch . '%')->get();
            return $query;
        }
    }
}
