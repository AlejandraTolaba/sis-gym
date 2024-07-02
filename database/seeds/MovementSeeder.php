<?php

use Illuminate\Database\Seeder;

class MovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movements')->delete();
        $methods_of_payment_id = [1,2,1];
        $concepts = ['Venta de Barrita de cereal (2)','Compra de agua (3)','Venta de agua 500ml (1)'];
        $types = ['INGRESO','EGRESO','INGRESO'];
        $amounts = [2800,1500,1500];


        for ($i=0; $i <sizeof($amounts) ; $i++) {
            DB::table('movements')
            ->insert([
                'method_of_payment_id' => $methods_of_payment_id[$i],
                'concept' => $concepts[$i],
                'type' => $types[$i],
                'amount' => $amounts[$i],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
