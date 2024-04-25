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
        'method_of_payment_id',
        'classes',
        'amount',
        'balance',
        'state'];
        

    public function activity(){
        return $this->belongsTo('App\Activity');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }

    public function student(){
        return $this->belongsTo('App\Student');
    }
    
}
