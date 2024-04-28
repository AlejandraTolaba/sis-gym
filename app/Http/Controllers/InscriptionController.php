<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Activity;
use App\Inscription;
use App\Movement;
use DB;
use Carbon\Carbon;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $student = Student::findOrFail($id);
        $inscriptions = $student->inscriptions;
        // $activities = $inscriptions->activities;
        // dd($inscriptions);
            
        return view('students.inscriptions.index',compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $activities = Activity::where('state','activa')->get();
        $methods_of_payment = DB::table('methods_of_payment')->get();
        $student= Student::where('id','=',$id)->first();
        // dd($student->id);
		return view('students.inscriptions.create',compact('activities', 'methods_of_payment', 'student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        request()->validate([
            'registration_date' => "required",
            'activity_id' => "required",
            'plan_id' => "required",
            'method_of_payment_id' => "required",
            'amount' => "required",
        ]);
        
        $inscription = new Inscription(request()->all());
        $inscription->student_id = $id;
        $expitarion = Carbon::now()->addMonth()->subDay();
        $inscription->expiration_date = $expitarion->toDateString();
        $plan = $inscription->plan_id; //obtengo una cadena de la forma "1_50.00"
        $pos=strpos($plan,'_'); //busco la posición del guion bajo
        $plan_id=substr($plan,0, $pos); //obtengo el id del plan elegido
        $inscription->plan_id = $plan_id;
        $inscription->classes = $inscription->plan->classes;
        $plan_price=(double)substr($plan,$pos+1); //obtengo el precio del plan elegido
        // dd($plan_price);
        if($plan_price!=$inscription->amount){
            $student = Student::findOrFail($id);
            $balance_prev=(double)$student->balance;
            $balance_new=(double)$plan_price - (double)$inscription->amount;
            $student->balance=$balance_prev+$balance_new;
            $student->update();
            $inscription->balance=$balance_new;
        }
        $inscription->save();
        if ($inscription->id) {
            $movement= new Movement();
            $movement->concept= "Inscripción N° ".$inscription->id;
            $movement->type="INGRESO";
            $movement->amount=$inscription->amount;
            $movement->method_of_payment_id= $inscription->method_of_payment_id;
            $movement->save();
        }
        return redirect('students')->with('info','Inscripción agregada con éxito');
        
        // dd($inscription);
        
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
