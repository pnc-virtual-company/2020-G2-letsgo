<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Event;
use App\Category;

class YourEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::all();
        return view('yourEvent.yourEvent',compact('categorys'));
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
        $user =  User::find(Auth::id());
        $yourevent = new Event;
        $yourevent-> $cat_id = $request->get('category');
        $yourevent->title = $request->get('title');
        $yourevent->startDate = $request->get('startDate');
        $yourevent->startTime = $request->get('startTime');
        $yourevent->endDate = $request->get('endDate');
        $yourevent->endTime = $request->get('endTime');
        $yourevent->city = $request->get('city');
        $yourevent->description = $request->get('drescription');

        if($request->picture != null){ 
            request()->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.request()->picture->getClientOriginalExtension();
            request()->picture->move(public_path('asset/userImage/'), $imageName);
            $user->picture = $imageName;
        }
        $yourevent->save();
        return back();
        // dd($yourevent);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function read(Request $request){
        file_get_contents(base_path('resources/lang/en.json'));
        // return $data;
        // return response()->json($data);
    }
    
}
