<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class TeacherTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateTeacher()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('teachers/create')
            ->see('Nuevo Profesor')
            ->see('Datos personales')
            ->type('Julia', 'name' )
            ->type('Perez', 'lastname' )
            ->type('21781731', 'dni' )
            ->type('1972-06-12', 'birthdate' )
            ->select('F','gender')
            ->type('Ciudad del Milagro', 'address' )
            ->type('154123123', 'phone_number' )
            ->type('4213711', 'contact_number' )
            ->type('jperez@gmail.com', 'email' )
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');

        $this->seeInDatabase('teachers', [
            'name'=>'Julia',
            'lastname'=>'Perez',
            'dni'=>'21781731',
            'birthdate'=>'1972-06-12 00:00:00',
            'gender'=>'F',
            'address'=>'Ciudad del Milagro',
            'phone_number'=>'154123123',
            'contact_number'=>'4213711',
            'email'=>'jperez@gmail.com',
            'state'=>'activo'
        ])
        ->seePageIs('teachers');
    }

    public function testEditTeacher()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);
        $this->actingAs($user)
            ->visit('teachers/1/edit')
            ->see('Editar datos de Marcela Lopez')
            ->type('España 100', 'address' )
            ->type('mlopez@gmail.com', 'email' )
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar')
            ->seePageIs('teachers');

            $this->seeInDatabase('teachers', [
                'id' => 1,
                'address'=>'España 100',
                'email'=>'mlopez@gmail.com'
            ]);
    }

    public function testShowTeacher()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);
        $this->actingAs($user)
            ->visit('teachers/1')
            ->see('Marcela Lopez')
            ->see('DNI:')
            ->see('21234321')
            ->see('Fecha de nacimiento')
            ->see('01-03-1971')
            ->see('Sexo:')
            ->see('Femenino')
            ->see('Domicilio:')
            ->see('Vicente Lopez 500')
            ->see('Teléfono:')
            ->see('3874314787')
            ->see('Volver')
            ->click('Volver')
            ->seePageIs('/');
    }

    public function testChangeStateTeacher()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('teachers')
            ->seeInElement("tbody", 'Marcela Lopez')
            ->click("delete-1")
            ->see('Desactivar Profesor')
            ->see('¿Está seguro que desea desactivar el profesor?')
            ->press('Confirm-1');
        $this->seeInDatabase('teachers', [
            'id' => 1,
            'state' => 'inactivo'
        ]);

        $this->actingAs($user)
            ->visit('teachers')
            ->click("delete-1")
            ->see('Activar Profesor')
            ->see('¿Está seguro que desea activar el profesor?')
            ->press('Confirm-1');
        $this->seeInDatabase('teachers', [
            'id' => 1,
            'state' => 'activo'
        ]);
    }
}
