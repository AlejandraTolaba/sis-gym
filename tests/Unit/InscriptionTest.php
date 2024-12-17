<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class InscriptionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreateInscription()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('students/inscriptions/create/1')
            ->see('Nueva Inscripción')
            ->see('Nombre del Alumno')
            ->see('Belén Lopez')
            ->see('Fecha de Inscripción')
            ->type('2024-06-09','registration_date')
            ->select(1,'activity_id')
            ->type('','plan_id')
            ->see('Precio')
            ->select(2,'method_of_payment_id')
            ->type(900,'amount')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
    }

    public function testUpdateBalanceInscription()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('students/inscriptions/1/show')
            ->see('Actualizar saldo')
            ->see('N° de inscripción:')
            ->see('1')
            ->see('Fecha de alta:')
            ->see('28-04-2023')
            ->see('Alumno:')
            ->see('Belén Lopez')
            ->see('Actividad:')
            ->see('Zumba')
            ->see('Plan:')
            ->see('12 clases')
            ->see('Saldo:')
            ->see('$2.000,00')
            ->select(1,'method_of_payment_id')
            ->type(2000,'amount')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
        $this->seeInDatabase('inscriptions', [
            'id'=>1,
            'balance'=>0
        ]);
        $this->seeInDatabase('movements', [
            'concept'=>"Act. Inscripción N° 1",
            'type'=>'INGRESO',
            'method_of_payment_id'=>1,
            'amount'=>2000
        ]);
    }

    public function testUpdateExpirationDateInscription()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('students/inscriptions/1/edit-expiration')
            ->see('Actualizar vencimiento')
            ->see('N° de inscripción:')
            ->see('1')
            ->see('Fecha de inscripción:')
            ->see('28-04-2023')
            ->see('Alumno:')
            ->see('Belén Lopez')
            ->see('Actividad:')
            ->see('Zumba')
            ->see('Fecha de vencimiento:')
            ->type('2023-06-01','expiration_date')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
        $this->seeInDatabase('inscriptions', [
            'id'=>1,
            'expiration_date'=>'2023-06-01 00:00:00'
        ]);
    }

    public function testDestroyInscription()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('students/inscriptions/1')
            ->see('Zumba')
            ->see('12 clases')
            ->click('delete-1')
            ->see('Eliminar inscripción')
            ->see('Está seguro que desea eliminar la inscripción')
            ->press('Confirm-1');
            $this->dontSeeInDatabase('inscriptions', [
                'id'=>1
            ]);
    }
}
