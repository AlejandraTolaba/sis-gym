<?php

use Illuminate\Database\Seeder;

class MethodOfPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('methods_of_payment')->delete();
        $data = ['Contado','Tarjeta de crédito','Tarjeta de débito'];

        for ($i=0; $i <sizeof($data) ; $i++) {
            DB::table('methods_of_payment')
            ->insert(['name' => $data[$i]]);
        }
    }
}
