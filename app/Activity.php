<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'state'
    ];

    public function plans(){
        return $this->belongsToMany('App\Plan');
    }
}
