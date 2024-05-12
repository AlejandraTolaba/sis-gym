<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table="movements";
    protected $primaryKey='id';

    protected $fillable= [
        'method_of_payment_id',
        'concept',
        'type',
        'amount'
    ];

    public function method_of_payment(){
        return $this->belongsTo('App\MethodOfPayment');
    }
}
