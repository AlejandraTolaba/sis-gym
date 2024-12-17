<?php

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->delete();
        $names = ['1 clase','8 clases','12 clases', '20 clases'];
        $classes = [1,8,12,20];


        for ($i=0; $i <sizeof($names) ; $i++) {
            DB::table('plans')
            ->insert([
                'name' => $names[$i],
                'classes' => $classes[$i]
            ]);
        }
    }
}
