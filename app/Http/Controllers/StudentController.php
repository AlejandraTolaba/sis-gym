<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $students = Student::all();
            return DataTables::of($students)
            ->addColumn('fullname', function($student){
                return $student->name.' '.$student->lastname;
            })
            ->addColumn('balance', function($student){
                return '$'.number_format($student->balance, 2, ',', '.');
            })
            ->setRowClass(function ($student) {
                return $student->balance > 0 ? "danger text-danger" : "";
            })
            ->addColumn('action', 'students.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(request()->all());
        request()->validate([
            'name' => 'required',
            'lastname' => 'required',
            'dni' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'address' =>'required',
            'phone_number' => 'required',
        ]);

        $student = new Student(request()->all());
        // dd($student);
        
        $student->save();
       
        return redirect('students')->with('info','Alumno agregado con éxito');
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
