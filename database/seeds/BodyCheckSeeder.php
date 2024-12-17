<?php

use Illuminate\Database\Seeder;

class BodyCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('body_checks')->delete();
        DB::table('body_checks')->insert([
            'student_id' => 1,
            'weight' => 50.5,
            'imc' => 20,
            'body_age'=>30,
            'body_fat' => 20,
            'imm'=>30,
            'mb' => 20,
            'visceral_fat'=>30,
        ]);
    }
}
