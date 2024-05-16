<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Student;
use App\Teacher;
use Carbon\Carbon;
use App\Attendance;

App::setLocale("es");

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::resource('activities','ActivityController');
Route::resource('students','StudentController');
// Route::resource('students/inscriptions','InscriptionController');
Route::get('students/inscriptions/create/{id}','InscriptionController@create')->name('inscriptions.create');
Route::post('students/inscriptions/{id}','InscriptionController@store')->name('inscriptions.store');
Route::get('students/inscriptions/{id}','InscriptionController@index')->name('inscriptions');

Route::get('students/inscriptions/{id}/show','InscriptionController@show')->name('inscriptions.show');
Route::post('students/inscriptions/{id}/show','InscriptionController@updateBalance')->name('inscriptions.updateBalance');

Route::get('students/inscriptions/{id}/edit-expiration','InscriptionController@editExpiration')->name('inscriptions.editExpiration');
Route::post('students/inscriptions/{id}/update-expiration','InscriptionController@updateExpiration')->name('inscriptions.updateExpiration');

Route::delete('students/inscriptions/{id}','InscriptionController@destroy')->name('inscriptions.destroy');
/*              Attendances             */
Route::get('attendances/register','InscriptionController@register')->name('attendances.register');
Route::get('attendances/showStudent','InscriptionController@showStudent')->name('attendances.showStudent');
Route::get('attendances/updateClasses/{id}','InscriptionController@updateClasses');

Route::get('attendances/showAttendances','AttendanceController@index')->name('attendances.index');
Route::get('attendances/showAttendancesByDay','AttendanceController@showAttendanceByDay')->name('attendances.byDay');

Route::get('dropdown2', function(){
    $date = Carbon::now()->toDateString();
	$activity = Request::get('option');
    // dd($activity);
	$attendances = Attendance::where(DB::raw('DATE(created_at)'),$date)->get()->where('activity',$activity)->pluck('fullname');
    // $count = $attendances->count();
	// dd($count);
    return $attendances;
});

/*              BodyChecks             */
Route::get('students/bodychecks/create/{id}','BodyCheckController@create')->name('bodychecks.create');
Route::post('students/bodychecks/{id}','BodyCheckController@store')->name('bodychecks.store');
Route::get('students/bodychecks/{id}','BodyCheckController@index')->name('bodychecks');
Route::get('students/bodychecks/{id}/edit','BodyCheckController@edit')->name('bodychecks.edit');
Route::put('students/bodychecks/{id}','BodyCheckController@update')->name('bodychecks.update');
Route::delete('students/bodychecks/{id}','BodyCheckController@destroy')->name('bodychecks.destroy');

Route::get('dropdown',function(){
    $id=Request::get('option');
    $activity = App\Activity::find($id);
    $plans = $activity->plans()->pluck('name',DB::raw('CONCAT(plan_id,"_",price) as plan'));
    return $plans;
});

Route::post('plans/create','PlanController@store');

/*              Teachers             */
Route::resource('teachers','TeacherController');
/*             Birthadays             */
Route::get('/birthdays',function(){
    $students = Student::where(DB::raw('date_format(birthdate,"%m-%d")'),DB::raw('date_format(now(),"%m-%d")'))->get();
    $teachers = Teacher::where(DB::raw('date_format(birthdate,"%m-%d")'),DB::raw('date_format(now(),"%m-%d")'))->get();
    // dd($students->isNotEmpty());
    return view("birthdays",compact('students','teachers'));
});

// 

Route::get('activity/{id}/inscriptions/index','ActivityController@showInscriptions')->name('showInscriptions');

Route::resource('movements','MovementController');

Route::resource('products','ProductController');

Route::resource('sales','SaleController');

Route::resource('users','UserController');