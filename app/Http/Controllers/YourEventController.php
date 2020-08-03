<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;
use App\Category;
use App\User;
use DB;
class YourEventController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $events = Event::all()->groupBy('startDate');
        $categories = Category::all();
        return view('yourEvent.yourEvent', compact(['events','categories']));
    }

    /**
     * Show the form for creating a nw resource.
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

    public function store( Request $request)
    {
        $request -> validate([
            'category' => 'required',
            'title' => 'required',
            'startDate' => 'required|date|date_format:Y-m-d|after:yesterday',
            'startTime' => 'required',
            'endDate' => 'required|date|date_format:Y-m-d|after:yesterday',
            'endTime' => 'required',
            'description' => 'required',
            'city' => 'required',
        ]);

        $user = Auth::id();
        $yourevent = new Event;
        $yourevent->cate_id = $request->get('category');
        $yourevent->title = $request->get('title');
        $yourevent->startDate = $request->get('startDate');
        $yourevent->startTime = $request->get('startTime');
        $yourevent->endDate = $request->get('endDate');
        $yourevent->endTime = $request->get('endTime');
        $yourevent->description = $request->get('description');
        $yourevent->city = $request->get('city');
        $yourevent->owner_id =   $user;
        if($request->picture != null){ 
            request()->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageName = time().'.'.request()->picture->getClientOriginalExtension();
                request()->picture->move(public_path('asset/eventimage/'), $imageName);
                $yourevent->picture = $imageName;
                
        }else {
            $yourevent->picture = "event.png";
        }
        $yourevent->save();
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
        $yourevent = Event::find($id);
        $this->authorize('update',$yourevent);
        request()->validate([
            'category' => 'required',
            'title' => 'required',
            'startDate' => 'required|date|date_format:Y-m-d|after:yesterday',
            'startTime' => 'required',
            'endDate' => 'required|date|date_format:Y-m-d|after:yesterday',
            'endTime' => 'required',
            'description' => 'required',
            'city' => 'required',
        ]);
        $yourevent->title = $request->get('title');
        $yourevent->cate_id  = $request->get('category');
        $yourevent->startDate = $request->get('startDate');
        $yourevent->startTime = $request->get('startTime');
        $yourevent->endDate = $request->get('endDate');
        $yourevent->endTime = $request->get('endTime');
        $yourevent->description = $request->get('description');
        $yourevent->city = $request->get('city');
        if($request->picture != null){ 
            if(\File::exists(public_path("asset/eventimage/{$yourevent->picture}"))){
                \File::delete(public_path("asset/eventimage/{$yourevent->picture}"));
            }
            request()->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.request()->picture->getClientOriginalExtension();
            request()->picture->move(public_path('asset/eventimage/'), $imageName);
            $yourevent->picture = $imageName;  
        }
        $yourevent -> save();
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
        $yourevent = Event::find($id);
        $this->authorize('update',$yourevent);
        if(\File::exists(public_path("asset/eventimage/{$yourevent->picture}"))){
            \File::delete(public_path("asset/eventimage/{$yourevent->picture}"));
        }
        $yourevent->delete();
        return back();
    
    }
    
}
