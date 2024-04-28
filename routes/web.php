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

App::setLocale("es");

Route::get('/', function () {
    return view('layouts.admin');
});

Auth::routes();

Route::resource('activities','ActivityController');
Route::resource('students','StudentController');
// Route::resource('students/inscriptions','InscriptionController');
Route::get('students/inscriptions/create/{id}','InscriptionController@create')->name('inscriptions.create');
Route::post('students/inscriptions/{id}','InscriptionController@store')->name('inscriptions.store');

Route::get('dropdown',function(){
    $id=Request::get('option');
    $activity = App\Activity::find($id);
    $plans = $activity->plans()->pluck('name',DB::raw('CONCAT(plan_id,"_",price) as plan'));
    return $plans;
});

Route::post('plans/create','PlanController@store');

Route::get('/home', 'HomeController@index')->name('home');
