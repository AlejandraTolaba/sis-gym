<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Plan;
use App\PlanActivity;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $activities = Activity::all();
            return DataTables::of($activities)
            // ->addColumn('action', 'activity.actions')
            // ->rawColumns(['action'])
            ->make(true);
        }
        return view('activities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::all();
        return view('activities.create', compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => "required|unique:activities,name",
        ]);
        
        $activity = new Activity(request()->all());
        
        for ($i=1; $i < 5 ; $i++) { 
            if($request->has('checkbox-'.$i)){
                $activity->save(); 
                $plan_activity = new PlanActivity();
                $plan_activity->activity_id = $activity->id;
                $plan_activity->plan_id = $i;
                $plan_activity->price = $request->get('price-'.$i);
                $plan_activity->save();
            }
        }
        return redirect('activities')->with('info','Actividad agregada con éxito');
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
