<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\BodyCheck;

class BodyCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $student = Student::findOrFail($id);
        // dd($student->bodychecks);
        return view('students.bodychecks.index',compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $student = Student::findOrFail($id);
        return view('students.bodychecks.create',compact('student'));
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
            'weight' => 'required',
            'imc' => 'required',
            'body_age' => 'required',
            'body_fat' => 'required',
            'imm' => 'required',
            'mb' =>'required',
            'visceral_fat' => 'required',
        ]);

        $bodycheck = new BodyCheck(request()->all());
        $bodycheck->student_id = $id;
        $bodycheck->save();
        return redirect('students/bodychecks/'.$bodycheck->student_id)->with('info','Ficha de control corporal agregada con éxito');
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
        $bodycheck = BodyCheck::findOrFail($id); 
        return view('students.bodychecks.edit',compact('bodycheck'));
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
        request()->validate([
            'weight' => 'required',
            'imc' => 'required',
            'body_age' => 'required',
            'body_fat' => 'required',
            'imm' => 'required',
            'mb' =>'required',
            'visceral_fat' => 'required',
        ]);
        $bodycheck = BodyCheck::findOrFail($id); 
        $bodycheck->fill($request->all());
        $bodycheck->update();
        return redirect('students/bodychecks/'.$bodycheck->student_id)->with('info','Ficha de control corporal editada con éxito');
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
