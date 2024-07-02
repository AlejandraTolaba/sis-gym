<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testCreateProduct()
    {
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('products/create')
            ->see('Nuevo producto')
            ->type(11,'code')
            ->type('Barrita de cereal' ,'name')
            ->type(20,'stock')
            ->type(1550.5,'price')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
        $this->seeInDatabase('products', [
            'id'=>1,
            'code'=>11,
            'name'=>'Barrita de cereal',
            'stock'=>20,
            'price'=>1550.5,
        ]);
    }

    public function testEditProduct()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('products/1/edit')
            ->see('Editar Producto')
            ->type(100,'stock')
            ->type(1700,'price')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
        $this->seeInDatabase('products', [
            'code'=>1,
            'name'=>'Barrita de cereal',
            'stock'=>100,
            'price'=>1700,
        ]);
    }

    public function testDestroyProduct()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('products')
            ->see('1')
            ->see('Barrita de cereal')
            ->click('delete-1')
            ->see('Eliminar Producto')
            ->see('Está seguro que desea eliminar el producto')
            ->press('Confirm-1');
            $this->dontSeeInDatabase('products', [
                'id'=>1,
                'name' => 'Barrita de cereal'
            ]);
    }
}
