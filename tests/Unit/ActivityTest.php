<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

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
        // $this->assertTrue(true);
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('activities/create')
            ->see('Nueva Actividad')
            ->type('Boxeo','name')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');

        $this->seeInDatabase('activities', [
                'name'=>'Boxeo',
                'state'=>'activa'
        ]);
    }

    public function testEditPlans()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('activities/1/edit')
        ->see('Editar planes de Zumba')
        ->select(['1_1 clase_1','2_8 clases_8'], 'plans_id')
        ->type([2000,9000], 'td_price[]')
        ->see('Guardar')
        ->see('Cancelar')
        ->press('Guardar')
        ->seePageIs('/activities');

        $this->seeInDatabase('activity_plan', [
            'plan_id'=>1,
            'activity_id'=>1,
            'price'=>2000,

            'plan_id'=>2,
            'activity_id'=>1,
            'price'=>9000
        ]);
    }

    public function testFilterInscriptionsByDate()
    {
        $this->assertTrue(true);
    }

    public function testChangeStateActivity()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('activities')
            ->seeInElement("tbody", 2)
            ->seeInElement("tbody", 'Funcional')
            ->click("delete-2")
            ->see('Desactivar Actividad')
            ->see('¿Está seguro que desea desactivar la actividad?')
            ->press('Confirm-2');
        $this->seeInDatabase('activities', [
            'name' => 'Funcional',
            'state' => 'inactiva'
        ]);

        $this->actingAs($user)
            ->visit('activities')
            ->click("delete-2")
            ->see('Activar Actividad')
            ->see('¿Está seguro que desea activar la actividad?')
            ->press('Confirm-2');
        $this->seeInDatabase('activities', [
            'name' => 'Funcional',
            'state' => 'activa'
        ]);
    }
}
