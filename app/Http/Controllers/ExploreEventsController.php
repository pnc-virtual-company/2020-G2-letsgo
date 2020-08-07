<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use Auth;
use App\Join;
use DB;
class ExploreEventsController extends Controller
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
    public function index(Request $request)
    {

        $exploreEvents = Event::all()->groupBy("startDate");
        $joins= Join::all();
        $joinEvent = Join::where('user_id',Auth::id())->get();

        $user = User::find(Auth::id());
        $user -> check = 0;
        $user->save();

        return view('exploreEvents.exploreEvents',compact('exploreEvents', 'joins','joinEvent'));
    }


    public function onlyEventJoin()
    {
        $exploreEvents = Event::all()->groupBy("startDate");
        $joins= Join::all();
        $joinEvent = Join::where('user_id',Auth::id())->get();

        $user = User::find(Auth::id());
        $user -> check = 1;
        $user->save();

        return view('exploreEvents.onlyEventJoin',compact('exploreEvents', 'joins','joinEvent'));
    }


    public function ifCheck($data)
    {
        $user = User::find(Auth::id());
        $user -> check = $data;
        $user->save();
        return redirect('exploreEvents');
    }
    public function ifnotcheck($data)
    {
        $user = User::find(Auth::id());
        $user -> check = $data;
        $user->save();
        return redirect('onlyEventJoin');
    }
    // view explore event by carlendar//
    public function viewByCarlendar(Request $request)
    {
        $user = Auth::id();
        $events = Event::all();
        $data = [];
        $date = date('Y-m-d');
        foreach($events as $event){
            if(Auth::id() != $event->owner_id && $event->endDate >= $date){
          $data[] = [
            'title' => $event->title,
            'start' => $event->startDate.'T'.$event->startTime,
            'end' => $event->endDate.'T'.$event->endTime
          ];
        }
        }
        return view('exploreEvents.viewByCarlendar', compact('data'));
    }
    //end view explore event by carlendar//
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
    public function join($id)
    {

        $event = Event::find($id);
        $user = Auth::id();
        $join = new Join;
        $join->user_id = $user;
        $join->event_id = $event->id;
        $join->save();
        return back();
    }

    public function quit($id){     
        $join = Join::find($id);
        $join->delete();
        return back();
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

}

