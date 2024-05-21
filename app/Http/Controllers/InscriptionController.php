<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Activity;
use App\Inscription;
use App\MethodOfPayment;
use App\Movement;
use App\Attendance;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        if ($request->ajax()){
            $inscriptions = $student->inscriptions;
            return DataTables::of($inscriptions)
            ->addColumn('activity', function($inscription){
                return $inscription->activity->name;
            })
            ->addColumn('plan', function($inscription){
                return $inscription->plan->name;
            })
            ->addColumn('expiration', function($inscription){
                return $inscription->expiration_date->format('d-m-Y');
            })
            ->addColumn('balance', function($inscription){
                return '$'.number_format($inscription->balance, 2, ',', '.');
            })
            ->addColumn('state', function($inscription){
                return ucfirst($inscription->state);
            })
            ->setRowClass(function ($inscription) {
                return $inscription->balance > 0 ? "text-danger" : "";
            })
            ->addColumn('action', 'students.inscriptions.actions')
            ->rawColumns(['photo','action'])
            ->make(true);
        }
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
        $methods_of_payment = MethodOfPayment::all();
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
        // dd($inscription);
        $method_of_payment_id = $request->get('method_of_payment_id');
        $amount = $request->get('amount');
        $inscription->student_id = $id;
        // dd($inscription->registration_date);
        $date = $inscription->registration_date;
        // dd($date);
        $expiration = $date->addMonth()->subDay();
        $inscription->expiration_date = $expiration;
        $plan = $inscription->plan_id; //obtengo una cadena de la forma "1_50.00"
        $pos=strpos($plan,'_'); //busco la posición del guion bajo
        $plan_id=substr($plan,0, $pos); //obtengo el id del plan elegido
        $inscription->plan_id = $plan_id;
        $inscription->classes = $inscription->plan->classes;
        $plan_price=(double)substr($plan,$pos+1); //obtengo el precio del plan elegido
        // dd($plan_price);
        if($plan_price!=$amount){
            $student = Student::findOrFail($id);
            $balance_prev=(double)$student->balance;
            $balance_new=(double)$plan_price - (double)$amount;
            $student->balance=$balance_prev+$balance_new;
            $student->update();
            $inscription->balance=$balance_new;
        }
        $inscription->save();
        $inscription->methods_of_payment()->attach($method_of_payment_id, ['amount' => $amount]);
        if ($inscription->id) {
            $movement= new Movement();
            $movement->concept= "Inscripción N° ".$inscription->id;
            $movement->type="INGRESO";
            $movement->amount=$amount;
            $movement->method_of_payment_id= $method_of_payment_id;
            $movement->save();
        }
        return redirect('students/inscriptions/'.$inscription->student->id)->with('success','Inscripción agregada con éxito');
        
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
        $inscription = Inscription::findOrFail($id); 
        $methods_of_payment = MethodOfPayment::all();
        // dd($inscription->methods_of_payment);
        return view('students.inscriptions.show',compact('inscription','methods_of_payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editExpiration($id)
    {
        $inscription = Inscription::findOrFail($id); 
        return view('students.inscriptions.edit',compact('inscription'));
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
        $inscription= Inscription::findOrFail($id);
        $attendances = $inscription->attendances;
        foreach ($attendances as $attendance) {
            $attendance->delete();
        }
        $inscription->methods_of_payment()->detach();
        $inscription->delete();
		return redirect('students/inscriptions/'.$inscription->student->id)->with('error','Inscripción eliminada con éxito');
    }


    /***
     * 
     * Attendances
     * 
     */
    public function register()
    {
        return view('students.attendances.register');
    }

    public function showStudent(Request $request)
    {
        $query=trim($request->get('searchText'));
        $student = Student::where('dni','LIKE',$query)->where('state','activo')->first();
        $isBirthday = false;
    
        if ($student) {
            $inscription = Inscription::where('student_id',$student->id)->where('state','activa')->first();
            if(isset($inscription)){
                if ($inscription->classes >= 1){
                    $inscription->classes--;
                    if ($inscription->classes == 0) {
                        $inscription->state = 'inactiva';
                    }
                    $inscription->update();
                   
                    $attendance = new Attendance();
                    $attendance->inscription_id = $inscription->id;
                    $attendance->save();
                }
                $currentDate = Carbon::now();
                if($student->birthdate->day == $currentDate->day && $student->birthdate->month == $currentDate->month){
                    $isBirthday = true;
                }
                return view('students.attendances.show',compact('inscription','isBirthday'));            
            }
            else{
                return Redirect::back()->with('error',"El DNI ". $query . " no tiene inscriptiones activas");   
            }
        }else{
            return Redirect::back()->with('error',"El DNI ". $query . " no está registrado");   
        }
            
    }

    public function updateBalance(Request $request, $id)
    {
        request()->validate([
            'method_of_payment_id' => "required",
            'amount' => "required",
        ]);

        $inscription = Inscription::findOrFail($id); 
        $prev_balance = (double)$inscription->balance;
        $amount=$request->get("amount");
        $method_of_payment_id = $request->get('method_of_payment_id');

        if($amount > $prev_balance){
            return Redirect::back()->with('error',"Error: El monto a pagar no puede ser superior al saldo"); 
        } else{
            $student = Student::findOrFail($inscription->student_id);
            $student->balance = (double)$student->balance - $amount;
            $student->update();
            // $inscription->balance = (double)$inscription->amount + $amount;
            $inscription->balance = (double)$prev_balance - $amount;
            $inscription->update();
            $inscription->methods_of_payment()->attach($method_of_payment_id,['amount' => $amount]);
            $movement = new Movement();
            $movement->concept = "Act. Inscripción N° ".$inscription->id;
            $movement->type = "INGRESO";
            $movement->method_of_payment_id = $method_of_payment_id;
            $movement->amount = $amount;
            $movement->save();

            return redirect('students/inscriptions/'.$inscription->student->id)->with('info',"Los cambios se realizaron con éxito");
        } 

    }

    public function updateExpiration(Request $request, $id)
    {
        request()->validate([
            'expiration_date' => "required"
        ]);
        $inscription = Inscription::findOrFail($id); 
        $inscription->fill($request->all());
        $inscription->update();
        return redirect('students/inscriptions/'.$inscription->student->id)->with('info',"Los cambios se realizaron con éxito"); 
    }
}
