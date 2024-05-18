<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $users = User::all();
            return DataTables::of($users)
            ->addColumn('action', 'users.actions')
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'name' => "required",
            'email' => "required|unique:users,email",
            'type' => "required",
            'password' => "required|confirmed",
            'password_confirmation' => "required"
        ]);
        $user = new User(request()->all());
        $user->password = bcrypt($request->get('password'));
        // dd($user);
        $user->save();
        return redirect('users')->with('info','Usuario agregado con éxito');
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
        $user = User::findOrFail($id);
        // dd(Auth::user()->password);
		return view('users.edit',compact('user'));
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
        $this->validate($request,[
			'password'=>'required',
            'new_password'=> 'required|confirmed',
		]);

        if(Hash::check($request->password,Auth::user()->password)){
			$user=\Auth::user();
			$user->password = bcrypt($request->new_password);
		    $user->update();
		    return Redirect::back()->with('info','Su contraseña se ha cambiado correctamente');
		}
        else{
			return Redirect::back()->with('error','La contraseña ingresada no coincide con la contraseña actual. Intente de nuevo');
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
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('users')->with('error','Usuario eliminado con éxito');
    }
}
