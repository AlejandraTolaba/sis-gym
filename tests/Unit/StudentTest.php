<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateStudent()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('students/create')
            ->see('Nuevo Alumno')
            ->see('Datos personales')
            ->type('Maria Macarena', 'name' )
            ->type('Gutierres', 'lastname' )
            ->type('35762123', 'dni' )
            ->type('1996-09-10', 'birthdate' )
            ->select('F','gender')
            ->type('Ciudad del norte', 'address' )
            ->type('11232', 'phone_number' )
            ->type('98475', 'contact_number' )
            ->type('gutierres@gmail.com', 'email' )
            ->see('Otros datos')
            ->select('0','certificate')
            ->type('No tiene', 'observations' )
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');

        $this->seeInDatabase('students', [
            'name'=>'Maria Macarena',
            'lastname'=>'Gutierres',
            'dni'=>'35762123',
            'birthdate'=>'1996-09-10 00:00:00',
            'gender'=>'F',
            'address'=>'Ciudad del norte',
            'phone_number'=>'11232',
            'contact_number'=>'98475',
            'email'=>'gutierres@gmail.com',
            'certificate'=>0,
            'observations'=>'No tiene',
            'state'=>'activo'
            ])
            ->seePageIs('students');
    }

    public function testEditStudent()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('students/1/edit')
            ->see('Editar datos de Belén Lopez')
            ->select('1','certificate')
            ->type('2024-03-30', 'certificate_date' )
            ->type('Sin observaciones', 'observations' )
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar')
            ->seePageIs('students');

            $this->seeInDatabase('students', [
                'id' => 1,
                'certificate'=>1,
                'certificate_date'=>'2024-03-30',
                'observations'=>'Sin observaciones',
            ]);
    }

    public function testShowStudent()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('students/1')
            ->see('Belén Lopez')
            ->see('DNI:')
            ->see('40234321')
            ->see('Fecha de nacimiento')
            ->see('01-03-1997')
            ->see('Sexo:')
            ->see('Femenino')
            ->see('Domicilio:')
            ->see('Vicente Lopez 146')
            ->see('Teléfono:')
            ->see('3874314848')
            ->see('Fecha de presentación de certificado:')
            ->see('11-03-2019')
            ->see('Observaciones:')
            ->see('Sin observaciones')
            ->see('Rutina:')
            ->see('Sin rutina')
            ->see('Volver')
            ->click('Volver')
            ->seePageIs('/');
    }
}
