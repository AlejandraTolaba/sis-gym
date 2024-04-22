<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanActivity extends Model
{
    protected $table="plans_activity";

    protected $fillable= ['activity_id','plan_id','price'];

    public function activity(){
        return $this->belongsTo(Actividad::class, 'activity_id');
    }

    public function plan(){
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
