<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class MovementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRegisterMovement()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('movements/create')
            ->see('Nuevo Movimiento')
            ->select('EGRESO','type')
            ->type('Compra de 15 lts de agua mineral','concept')
            ->select(1,'method_of_payment_id')
            ->type(25000.0,'amount')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');

            $this->seeInDatabase('movements', [
                'type'=>'EGRESO',
                'concept'=>'Compra de 15 lts de agua mineral',
                'method_of_payment_id'=>1,
                'amount'=>25000.0
            ]);
    }

    public function testFilterMovementsByDate()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('movements')
            ->see('Movimientos')
            ->type(now()->format('d-m-Y'),'from')
            ->type(now()->format('d-m-Y'),'to')
            ->press('Buscar')
                ->seeInElement("table",now()->format('d-m-Y'))
                ->seeInElement("table",now()->format('d-m-Y'))
                ->dontSeeInElement("table",'02-06-2024');
    }
}
