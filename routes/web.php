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
/*              Attendances             */
Route::get('attendances/register','InscriptionController@register')->name('attendances.register');
Route::get('attendances/showStudent','InscriptionController@showStudent')->name('attendances.showStudent');
Route::get('attendances/updateClasses/{id}','InscriptionController@updateClasses');

/*              BodyChecks             */
Route::get('students/bodychecks/create/{id}','BodyCheckController@create')->name('bodychecks.create');
Route::post('students/bodychecks/{id}','BodyCheckController@store')->name('bodychecks.store');
Route::get('students/bodychecks/{id}','BodyCheckController@index')->name('bodychecks');

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

Route::get('activity/{id}/showInscriptions','ActivityController@showInscriptions')->name('showInscriptions');
Route::post('activity/{id}/showInscriptions','ActivityController@showInscriptionsFromTo')->name('showInscriptionsFromTo');

Route::get('/home', 'HomeController@index')->name('home');
