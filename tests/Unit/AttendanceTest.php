<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRegisterAttendance()
    {
        // $this->assertTrue(true);
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'E',
        ]);

        $this->actingAs($user)
            ->visit('attendances/register')
            ->type('40234321','searchText')
            ->press('Registrar Asistencia')
            ->seePageIs('/attendances/showStudent?searchText=40234321')
            ->see('Belén Lopez')
            ->see('Zumba')
            ->see('Clases restantes')
            ->see('11 clases')
            ->click('Volver');
    }
}
