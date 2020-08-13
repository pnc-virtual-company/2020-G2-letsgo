<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;
use App\Category;
use Intervention\Image\ImageManagerStatic as Image;
class YourEventController extends Controller
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
     
        $events = Event::all()->groupBy('startDate');
        $categories = Category::all();
        return view('yourEvent.yourEvent', compact(['events','categories']));
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
            'title' => 'required|min:3|max:45',
            'startDate' => 'required|date|date_format:Y-m-d',
            'startTime' => 'required',
            'endDate' => 'required|date|date_format:Y-m-d',
            'endTime' => 'required',
            'description' => 'required|min:50|max:250',
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
        if($request->hasFile('picture')) {
            $image = $request->file('picture');            
            $filename = time().'.'.request()->picture->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());  
            $image_resize->resize(100, 100);        
            $yourevent-> picture=   $filename;
            $image_resize->save(public_path('asset/eventimage/' .$filename));
        }else {
            $yourevent-> picture=   'event.png';
        }
        $yourevent->save();
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
        // dd($id);
        $yourevent = Event::find($id);
        $this->authorize('update',$yourevent);
        request()->validate([
            'category' => 'required',
            'title' => 'required|min:3|max:45',
            'startDate' => 'required|date|date_format:Y-m-d',
            'startTime' => 'required',
            'endDate' => 'required',
            'endTime' => 'required',
            'description' => 'required|min:50|max:250',
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

        if($request->hasFile('picture')) {

            if(\File::exists(public_path("asset/eventimage/{$yourevent->picture}"))){
                \File::delete(public_path("asset/eventimage/{$yourevent->picture}"));
            }

            $image = $request->file('picture');            
            $filename = time().'.'.request()->picture->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());  
            $image_resize->resize(100, 100);        
            $yourevent-> picture=   $filename;
            $image_resize->save(public_path('asset/eventimage/' .$filename));
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
        if ($yourevent->picture != 'event.png') {
            if(\File::exists(public_path("asset/eventimage/{$yourevent->picture}"))){
                \File::delete(public_path("asset/eventimage/{$yourevent->picture}"));
            }
        }
        $yourevent->delete();
        return back();
    
    }
    
}
