<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $teachers = Teacher::all();
            // dd($teachers);
            return DataTables::of($teachers)
            ->addColumn('fullname', function($teacher){
                return $teacher->name.' '.$teacher->lastname;
            })
            ->addColumn('photo', function($teacher){
                if (empty($teacher->photo)) {
                    return 'avatar.png';
                }
                return '<img src="/img/teachers/'.$teacher->photo.'" width="50px" height="50px">';
            })
            ->addColumn('state', function($teacher){
                return ucfirst($teacher->state);
            })
            ->addColumn('action', 'teachers.actions')
            ->rawColumns(['photo','action'])
            ->make(true);
        }
        return view('teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
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
            'name' => 'required',
            'lastname' => 'required',
            'dni' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'address' =>'required',
            'phone_number' => 'required',
        ]);

        $teacher = new Teacher(request()->all());
        $img = $request->get('photo_camera');
        if ($img!=""){
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $image = base64_decode($img);
            $temp_name = Str::random(5);
            $extension="png";
            $photo_name=  $temp_name.'-'.date('Y-m-d').'.'.$extension; 
            Image::make($image)->resize(144,144)->save(public_path('img/teachers/'.$photo_name));
            $teacher->photo=$photo_name;
        }
        else{
            $teacher->photo= 'avatar.png';
        }
        // dd($teacher->photo);
        $teacher->save();
       
        return redirect('teachers')->with('info','Profesor agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
		return view("teachers.show",compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit',compact('teacher'));
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
        $teacher = Teacher::findOrFail($id);
        $teacher->fill($request->all());
        // dd($teacher);
        $img = $request->get('photo_camera');
        if ($img!=""){
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $image = base64_decode($img);
            $temp_name = Str::random(5);
            $extension="png";
            $photo_name=  $temp_name.'-'.date('Y-m-d').'.'.$extension; 
            Image::make($image)->resize(144,144)->save(public_path('img/teachers/'.$photo_name));
            $teacher->photo=$photo_name;
        }
        else{
            $teacher->photo= 'avatar.png';
        }
        $teacher->update();

        if ( $teacher->update() ){
            return redirect('teachers')->with('info','Los cambios se guardaron exitosamente');
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
