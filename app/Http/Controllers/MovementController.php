<?php

namespace App\Http\Controllers;

use App\MethodOfPayment;
use App\Movement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $today = Carbon::today();
        // dd($request);
        $from = $request->get('from');
        $to = $request->get('to');
        if ($from != $to) {
            $movements = Movement::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->with(['method_of_payment:id,name'])->orderBy('id','desc')->get();
        }
        else{
            $movements = Movement::whereDate('created_at',$today)->with(['method_of_payment:id,name'])->orderBy('id','desc')->get();
        }
        $today = $today->toDateString();
        return view('movements.index', compact('today','movements','from','to'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $methods_of_payment = MethodOfPayment::all();
        return view('movements.create',compact('methods_of_payment'));
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
            'concept' => "required",
            'type' => "required",
            'method_of_payment_id' => "required",
            'amount' => "required",
        ]);
        $movement = new Movement(request()->all());
        // dd($movement);
        $movement->save();
        return redirect('movements')->with('info','Movimiento agregado con éxito');
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
