<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Plan;
use App\ActivityPlan;
use App\Inscription;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

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
            ->addColumn('state', function($activity){
                return ucfirst($activity->state);
            })
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
        $cont = 0;
        while ( $cont < count($plans) ) {
            $activity->save(); 
            $data_plans = explode("_",$plans[$cont]);
            $activity->plans()->attach($data_plans[0],['price' => $prices[$cont]]);
            $cont = $cont+1;
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
        $activity = Activity::where('id',$id)->where('state','activa')->first();
        $plans=$request->get('plans_id');
        // dd($plans);
        $prices=$request->get('td_price');
        // dd($prices);
        $cont = 0;
        $plans_id = [];
        while ( $cont < count($plans) ) {
            $data_plan = explode("_",$plans[$cont]);
            $plan_id = $data_plan[0];
            array_push($plans_id, $plan_id);
            if ($activity->plans->contains('id', $plan_id)) {
                $price = $activity->plans[$cont]->pivot->price; //precio guardado
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
                $activity->plans()->attach($plan_id,['price' => $prices[$cont]]);
                $cont++;
            }
        }

        $activity->plans()->sync($plans_id);
        
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

    public function showInscriptions(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $today = Carbon::today();
        $from = $request->get('from');
        $to = $request->get('to');
        if ($from != $to) {
            $inscriptions = $activity->inscriptions->sortKeysDesc()->all();
        }
        else{
            $inscriptions = $activity->inscriptions->whereBetween('registration_date',[$from,$to])->all();
        }
        $today = $today->toDateString();
        
        return view('activities.showInscriptions',compact('inscriptions','activity','from','to','today'));
    }
}
