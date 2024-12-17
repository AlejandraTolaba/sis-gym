<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $table="inscriptions";
    protected $primaryKey='id';

    protected $fillable= [
        'registration_date',
        'expiration_date',
        'student_id',
        'activity_id',
        'plan_id',
        'classes',
        'balance',
        'state'
    ];
        
    protected $dates = [
        'expiration_date','registration_date'
    ];
    
    protected $casts = [
        'expiration_date' => 'datetime:Y-m-d',
        'registration_date' => 'datetime:Y-m-d'
    ];

    public function activity(){
        return $this->belongsTo('App\Activity');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }

    public function methods_of_payment(){
        return $this->belongsToMany('App\MethodOfPayment','inscription_method_of_payment')->withPivot('amount')->withTimestamps();
    }

    public function attendances(){
        return $this->hasMany('App\Attendance');
    }
    
}
