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
        $data = $request->get('value');
        if($request->ajax()){
            $events = Event::all();
            if($data ==null){
                $value[] = Event::all();
                return $value;
            }else {
                $joins = Join::where('user_id',$data)->get();
                if(!$joins->isEmpty()){
                    foreach ($joins as $join) {
                    $value[] = Event::where('id',$join->event_id)->get();
                    }
                    return $value;
                }else {
                    return $joins;
                }
            }
        }
        $exploreEvents = Event::all();
        $members=[];
            foreach ($exploreEvents as $exploreEvent) {
                $members[] = ['id' => $exploreEvent->id,'members' => $exploreEvent->joins->count('user_id')];
        }
        $event_join_only = Join::where('user_id',Auth::user())->get();
        return view('exploreEvents.exploreEvents',compact(['members','event_join_only']));
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
