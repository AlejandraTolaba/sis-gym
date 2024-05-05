<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table='students'; 

    protected $primaryKey='id';
    
    protected $fillable = [
    	'name',
    	'lastname',
        'dni',
        'birthdate',
        'gender',
    	'address',
    	'phone_number',
    	'contact_number',
        'email',
        'certificate',
        'certificate_date',
        'observations',
        'state',
        'balance',
        'photo',
        'routine'
        
    ];

    public function inscriptions(){
        return $this->hasMany('App\Inscription');
    }

    public function bodychecks(){
        return $this->hasMany('App\BodyCheck');
    }

}
