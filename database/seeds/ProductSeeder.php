<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        $codes = ['0001','0002','0003'];
        $names = ['Barrita de cereal','Agua 500 ml','Agua 1L'];
        $stocks = [50,7,9];
        $prices = [1400,1700,2250];


        for ($i=0; $i <sizeof($names) ; $i++) {
            DB::table('products')
            ->insert([
                'code' => $codes[$i],
                'name' => $names[$i],
                'stock' => $stocks[$i],
                'price' => $prices[$i]
            ]);
        }
    }
}
