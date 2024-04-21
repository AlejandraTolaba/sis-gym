<?php

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('activities')->delete();
        $data = ['Zumba','Funcional','Telas'];

        for ($i=0; $i <sizeof($data) ; $i++) {
            DB::table('activities')
            ->insert(['name' => $data[$i]]);
        }
    }
}
