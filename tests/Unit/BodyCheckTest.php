<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class BodyCheckTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateBodyCheckStudent()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('/students/bodychecks/create/1')
            ->see('Nueva ficha de control corporal')
            ->type(50.500 ,'weight')
            ->type(21.9,'imc')
            ->type(40,'body_age')
            ->type(40,'body_fat')
            ->type(40,'imm')
            ->type(40,'mb')
            ->type(40,'visceral_fat')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
        $this->seeInDatabase('body_checks', [
            'student_id'=>1,
            'weight'=>50.500,
            'imc'=>21.9,
            'body_age'=>40,
            'body_fat'=>40,
            'imm'=>40,
            'mb'=>40,
            'visceral_fat'=>40
        ]);
    }

    public function testEditBodyCheckStudent()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('/students/bodychecks/1/edit')
            ->see('Editar ficha de control corporal')
            ->type(31,'body_age')
            ->type(40,'body_fat')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
        $this->seeInDatabase('body_checks', [
            'student_id'=>1,
            'body_age'=>31,
            'body_fat'=>40
        ]);
    }

    public function testDestroyBodyCheckStudent()
    {
        $this->seed();
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('/students/bodychecks/1')
            ->click('delete-1')
            ->see('Eliminar ficha de control corporal')
            ->see('Está seguro que desea eliminar la ficha de control')
            ->press('Confirm-1');
        $this->dontSeeInDatabase('body_checks', [
            'id'=>1,
        ]);
    }
}
