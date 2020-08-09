<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use Auth;
use App\Join;
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

    // display only event that user join on explore event
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

    // Checkbox is checked on explore event
    public function ifCheck($data)
    {
        $user = User::find(Auth::id());
        $user -> check = $data;
        $user->save();
        return redirect('exploreEvents');
    }

    // Checkbox is not check on explore event
    public function ifnotcheck($data)
    {
        $user = User::find(Auth::id());
        $user -> check = $data;
        $user->save();
        return redirect('onlyEventJoin');
    }

    // view explore event by carlendar//
    public function viewByCarlendar()
    {
        $user = User::find(Auth::id());
        $user -> check = 0;
        $user->save();
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

    // display only event use on calendar
    public function onlyEventUserOnCalendar()
    {
        $user = User::find(Auth::id());
        $user -> check = 1;
        $user->save();

        $events = Event::all();
        $data = [];
        $joinOnly = Join::where('user_id',Auth::id())->get();
        $date = date('Y-m-d');
        foreach($events as $event){
            if(Auth::id() != $event->owner_id && $event->endDate >= $date){
                foreach ($joinOnly as $join) {
                    if ($join->user_id == Auth::id() && $join->event_id == $event->id) {
                        $data[] = [
                            'title' => $event->title,
                            'start' => $event->startDate.'T'.$event->startTime,
                            'end' => $event->endDate.'T'.$event->endTime
                        ];
                    }
                }
            }
        }
        return view('exploreEvents.onlyEventUserOnCalendar', compact('data'));
    }

    // Checkbox is checked on calendar
    public function ifcheckOnCalendar($data)
    {
        $user = User::find(Auth::id());
        $user -> check = $data;
        $user->save();
        return redirect('onlyEventUserOnCalendar');
    }

    // Checkbox is not check on Calendar
    public function ifNocheckOnCalendar($data)
    {
        $user = User::find(Auth::id());
        $user -> check = $data;
        $user->save();
        return redirect('carlendar');
    }
 
    // user join event
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

    // user quit event
    public function quit($id){     
        $join = Join::find($id);
        $join->delete();
        return back();
    }
   
}

