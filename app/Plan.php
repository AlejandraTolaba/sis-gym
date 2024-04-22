<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table="plans";
    protected $primaryKey= 'id';

    protected $fillable= ['name','classes'];

    public function activities(){
        return $this->belongsToMany('App\Activity');
    }
}
