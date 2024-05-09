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
    public function index()
    {
        $today = Carbon::today();
        // dd($today);
        $movements = Movement::whereDate('created_at',$today)->with(['method_of_payment:id,name'])->orderBy('id','desc')->get();
        // dd($movements);
        $total_incomes = Movement::whereDate('created_at',$today)->where('method_of_payment_id',1)->where('type','INGRESO')->get()->sum('amount');
        $total_expenses = Movement::whereDate('created_at',$today)->where('method_of_payment_id',1)->where('type','EGRESO')->get()->sum('amount');
        $total = $total_incomes - $total_expenses;
        $total_incomes = number_format($total_incomes,2,',','.');
        $total_expenses = number_format($total_expenses,2,',','.');
        $total = number_format($total,2,',','.');
        $today = $today->toDateString();
        return view('movements.index', compact('today','movements','total_incomes','total_expenses','total'));
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
