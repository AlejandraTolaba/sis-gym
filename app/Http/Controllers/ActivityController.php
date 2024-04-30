<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Plan;
use App\ActivityPlan;
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
            ->addColumn('action', 'activities.actions')
            ->rawColumns(['action'])
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
        $plans=$request->get('plans_id');
        $prices=$request->get('td_price');
        // dd($prices);
        $cont = 0;
        while ( $cont < count($plans) ) {
            $activity->save(); 
            $data_plans = explode("_",$plans[$cont]);
            $plan_activity = new ActivityPlan();
            $plan_activity->activity_id = $activity->id;
            $plan_activity->plan_id =$data_plans[0];
            $plan_activity->price = $prices[$cont];
            $plan_activity->save();
            $cont = $cont+1;
            // dd($data_plans);
        }
        
        if ($activity->id == null) {
            $activity->save(); 
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
        $activity = Activity::findOrFail($id);
        // dd($activity->plans);
        $plans = Plan::all();
        return view('activities.edit', compact('activity','plans'));
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
        // dd($request);
        $activity_plan = ActivityPlan::where('activity_id',$id)->pluck('price','plan_id')->sortKeys()->all();
        // dd($activity_plan);
        $plans=$request->get('plans_id');
        // dd($plans);
        $prices=$request->get('td_price');
        // dd($prices);
        $cont = 0;
        $data_plans = [];
        while ( $cont < count($plans) ) {
            $data_plan = explode("_",$plans[$cont]);
            $plan_id = $data_plan[0];
            $data_plans[$plan_id] = $prices[$cont];
            // dd($data_plans);
            if (array_key_exists($plan_id, $activity_plan)) {
                // dd($activity_plan[$plan_id]);
                $price = $activity_plan[$plan_id]; //precio guardado
                if ($price !== $prices[$cont]) {
                    $ap = ActivityPlan::where('activity_id',$id)->where('plan_id',$plan_id)->first();
                    $ap->price = $prices[$cont];
                    $ap->update();
                    $cont++;
                }
                else{
                    $cont++;
                }
            }
            else{
                $activity_plan_new = new ActivityPlan();
                $activity_plan_new->activity_id = $id;
                $activity_plan_new->plan_id = $plan_id;
                $activity_plan_new->price = $prices[$cont];
                $activity_plan_new->save();
                $cont++;
                }
        }
        
        $diff = array_diff_key($activity_plan, $data_plans);
        // dd(array_keys($diff));
        for ($i=0; $i < count($diff); $i++) { 
            $p_id = array_keys($diff)[$i];
            // dd($p_id);
            $p = ActivityPlan::where('activity_id',$id)->where('plan_id',$p_id)->first();
            $p->delete();
        }
        return redirect('activities')->with('info','Actividad editada con éxito');
        
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
