<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table="sales";
    protected $primaryKey='id';

    protected $fillable= [
        'quantity',
        'price'
    ];

    public function products(){
        return $this->belongsToMany('App\Product','product_sale')->withTimestamps();
    }
}
