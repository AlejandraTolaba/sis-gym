<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table="sales";
    protected $primaryKey='id';

    protected $fillable= [
        'total',
        'method_of_payment_id'
    ];

    public function products(){
        return $this->belongsToMany('App\Product','product_sale')->withPivot('quantity','price')->withTimestamps();
    }
}
