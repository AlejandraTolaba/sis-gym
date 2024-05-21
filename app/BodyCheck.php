<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyCheck extends Model
{
    protected $table="body_checks";

    protected $fillable= [
        'student_id',
        'weight',
        'imc',
        'body_age',
        'body_fat',
        'imm',
        'mb',
        'visceral_fat'
    ];
    public function student(){
        return $this->belongsTo('App\Student');
    }
}
