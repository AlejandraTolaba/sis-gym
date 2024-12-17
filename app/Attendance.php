<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table="attendances";

    protected $fillable= ['inscription_id'];
    protected $appends = ['activity','fullname'];

    public function inscription(){
        return $this->belongsTo('App\Inscription', "inscription_id");
    }

    public function getActivityAttribute(){
        $id = $this->inscription()->get('activity_id');
        return $id[0]['activity_id'];
    }
    
    public function getFullnameAttribute(){
       $student =  $this->inscription()->with('student')->first();
       return $student['student']->name.' '.$student['student']->lastname;
    }
}
