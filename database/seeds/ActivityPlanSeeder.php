<?php

use Illuminate\Database\Seeder;

class ActivityPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity_plan')->delete();
        $prices = [1000,8000,12000];

        for ($i=0; $i <sizeof($prices) ; $i++) {
            DB::table('activity_plan')
            ->insert(['activity_id' => 1,
            'plan_id'=> $i+1,
            'price'=> $prices[$i]
                ]);
        }
    }
}
