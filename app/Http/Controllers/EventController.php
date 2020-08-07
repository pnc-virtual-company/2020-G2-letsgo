<?php

namespace App\Http\Controllers;
use App\Event;
use App\Join;

class EventController extends Controller
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
        $this->authorize('view', Event::class);
        $event = Event::all();
        $joins= Join::all();
        return view('manage.events.viewEvents',compact('event', 'joins'));
        
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $this->authorize('delete_event', Event::class);
        $event = Event::find($id);
        $event->delete();
        return back();
    }


}
