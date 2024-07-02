<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use UserSeeder;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testChangePasswordUser()
    {
        $this->seed(UserSeeder::class);
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('users/1/edit')
            ->see('Modificar Contraseña')
            ->type('admin1234','password')
            ->type('12345678','new_password')
            ->type('12345678','new_password_confirmation')
            ->see('Guardar')
            ->see('Cancelar')
            ->press('Guardar');
    }

    public function testDestroyUser()
    {
        $user = factory(User::class)->create([
            'type' => 'A',
        ]);

        $this->actingAs($user)
            ->visit('users')
            ->click('delete-1')
            ->see('Eliminar Usuario')
            ->see('¿Está seguro que desea eliminar el usuario?')
            ->press('Confirm-1');
        $this->dontSeeInDatabase('users', ['id' => 1]);
    }
}
