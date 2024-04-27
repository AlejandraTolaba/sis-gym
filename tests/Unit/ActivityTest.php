<?php

namespace Tests\Unit;

use Tests\TestCase;

class ActivityTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateActivity()
    {
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
