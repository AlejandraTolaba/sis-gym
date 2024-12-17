<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class SaleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateSale()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('sales/create')
            ->see('Nueva Venta')
            ->select(['1_1_Barrita de cereal_50_1400.0','2_2_Agua 500 ml_7_1700.0'], 'products_id')
            ->select(1,'method_of_payment_id')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
        $this->seeInDatabase('sales', [
            'id'=>1,
            'total'=>3100.0,
            'method_of_payment_id'=>1,
        ]);
        $this->seeInDatabase('product_sale', [
            'sale_id'=>1,
            'product_id'=>1,
            'quantity'=>1,
            'price'=>1400.0,

            'sale_id'=>1,
            'product_id'=>2,
            'quantity'=>1,
            'price'=>1700.0,
        ]);
    }
}
