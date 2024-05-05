<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MethodOfPayment extends Model
{
    protected $table="methods_of_payment";
    protected $primaryKey='id';

    protected $fillable= [
        'name'
    ];

    public function inscriptions(){
        return $this->belongsToMany('App\Inscription','inscription_method_of_payment')->withPivot('amount')->withTimestamps();
    }
}
