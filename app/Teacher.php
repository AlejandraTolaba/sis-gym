<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table='teachers'; 

    protected $primaryKey='id';
    
    protected $fillable = [
    	'name',
    	'lastname',
        'dni',
        'photo',
        'birthdate',
        'gender',
    	'address',
    	'phone_number',
    	'contact_number',
        'email',
        'state'
    ];

    protected $dates = [
        'birthdate'
    ];

    protected $casts = [
        'birthdate' => 'datetime:Y-m-d',
    ];
}
