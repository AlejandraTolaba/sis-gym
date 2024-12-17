<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";
    protected $primaryKey='id';

    protected $fillable= [
        'code',
        'name',
        'stock',
        'price'
    ];

    public function sales(){
        return $this->belongsToMany('App\Sale','product_sale')->withPivot('quantity','price')->withTimestamps();
    }
}
