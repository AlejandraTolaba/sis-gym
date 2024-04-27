<?php

namespace Tests\Unit;
use PlanSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateActivity()
    {
        $this->seed(PlanSeeder::class);
        $this->visit('activities/create')
            ->see('Nueva Actividad')
            ->type('Boxeo','name')
            ->check('checkbox-1')
            ->type(2000,'price-1')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');

        $this->seeInDatabase('activities', [
                'name'=>'Boxeo',
                'state'=>'activa'
                ]);
    }
}
