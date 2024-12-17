<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityPlan extends Model
{
    protected $table="activity_plan";

    protected $fillable= ['activity_id','plan_id','price'];

}
