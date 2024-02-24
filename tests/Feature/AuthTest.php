<?php

namespace Tests\Feature;
//Librerias
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
//PRUEBAS DE TESTEO RESPECTO A LAS VISTAS DE AUTENTICACIÓN (AUTH)
class AuthTest extends TestCase
{
    use RefreshDatabase;
    //Prueba de registrar usuarios con datos validos
    /** @test */
    public function test_usuario_puede_registrar_con_datos_validos()
    {
        $response = $this->post('/register', [
            'name' => 'Sergio Montiel',
            'email' => 'sergiomontiel@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }
    //Prueba para registrar usuario con datos invalidos
    /** @test */
    public function test_usuario_no_puede_registrarse_con_datos_inválidos()
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password456',
        ]);

        $response->assertSessionHasErrors(['name', 'email']);
        $this->assertGuest();
    }
    //Prueba para iniciar sesion con datos validos
    /** @test */
    public function test_usuario_puede_iniciarsesión_con_credenciales_validas()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }
    //Prueba para iniciar sesion con datos invalidos
    /** @test */
    public function test_usuario_no_puede_iniciarsesión_con_credenciales_inválidas()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
    //Prueba para iniciar sesion cuando el correo no esta registrado
    /** @test */
    public function test_usuario_no_puede_iniciarsesión_con_correo_correo_no_registrado()
    {
        $response = $this->post('/login', [
            'email' => 'noexistente@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
    //Prueba de que el usuario puede cerrar session
    /** @test */
    public function test_usuario_puede_cerrarsesión()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
