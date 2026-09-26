<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    // Limpia la base de datos de prueba después de cada test
    use RefreshDatabase;

    /**
     * Prueba que la página de login carga correctamente.
     */
    public function test_pantalla_de_login_se_puede_renderizar(): void
    {
        $response = $this->get('/login');

        // Verificamos que el código de respuesta HTTP sea 200 (Éxito)
        $response->assertStatus(200);
    }

    /**
     * Prueba que un nuevo usuario puede registrarse en el sistema.
     */
    public function test_usuario_puede_registrarse(): void
    {
        $response = $this->post('/register', [
            'name' => 'Usuario Pruebas',
            'email' => 'prueba@ejemplo.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Verificamos que sea redirigido a la lista de tareas tras el registro
        $response->assertRedirect('/tasks');

        // Verificamos que el usuario realmente se guardó en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'prueba@ejemplo.com',
        ]);

        // Verificamos que el usuario esté autenticado en la sesión
        $this->assertAuthenticated();
    }
}
