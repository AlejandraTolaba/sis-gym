<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Attendance;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now()->toDateString();
        $activities = Activity::where('state','activa')->get();
        // dd($activities);
        $attendances = Attendance::where(DB::raw('DATE(created_at)'),$date)->with('inscription')->get();
        return view('students.attendances.index',compact('activities','attendances','date')); 
    }

    public function showAttendanceByDay(Request $request){
        $date=Carbon::createFromFormat('Y-m-d',$request->get('date'))->toDateString();
        $activities = Activity::where('state','activa')->get();
        $activity  = $request->get('activity');
        // dd($activity);
    
        if($activity == 0){
            $attendances = Attendance::where(DB::raw('DATE(created_at)'),$date)->with('inscription')->get();
            // dd($attendances);
        }
        else{
            $attendances = Attendance::where(DB::raw('DATE(created_at)'),$date)->get()->where('activity',$activity);
            // dd($attendances);
        }
        return view('students.attendances.index',compact('activities','attendances','date','activity')); 
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
