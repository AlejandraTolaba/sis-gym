<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Yajra\DataTables\DataTables;
use Image;
use Illuminate\Support\Str;


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
            ->addColumn('state', function($activity){
                return ucfirst($activity->state);
            })
            ->setRowClass(function ($student) {
                return $student->balance > 0 ? "text-danger" : "";
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
        $img = $request->get('photo_camera');
        // Para guardar la foto del alumno en la carpeta public/imagenes/alumnos
        if ($img!=""){
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $image = base64_decode($img);
            $temp_name = Str::random(5);
            $extension="png";
            $photo_name=  $temp_name.'-'.date('Y-m-d').'.'.$extension; 
            Image::make($image)->resize(144,144)->save(public_path('img/students/'.$photo_name));
            $student->photo=$photo_name;
        }
        else{
            $student->photo= 'avatar.png';
        }
        // dd($student->photo);
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
        $student = Student::findOrFail($id);
		return view("students.show",compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit',compact('student'));
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
            'name' => 'required',
            'lastname' => 'required',
            'dni' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'address' =>'required',
            'phone_number' => 'required',
        ]);
        $student = Student::findOrFail($id);
        $student->fill($request->all());
        // dd($student);
        $img = $request->get('photo_camera');
        // Para guardar la foto del alumno en la carpeta public/imagenes/alumnos
        if ($img!=""){
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $image = base64_decode($img);
            $temp_name = Str::random(5);
            $extension="png";
            $photo_name=  $temp_name.'-'.date('Y-m-d').'.'.$extension; 
            Image::make($image)->resize(144,144)->save(public_path('img/students/'.$photo_name));
            $student->photo=$photo_name;
        }
        else{
            $student->photo= 'avatar.png';
        }
        $student->update();

        if ( $student->update() ){
            return redirect('students')->with('info','Los cambios se guardaron exitosamente');
        } 
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
