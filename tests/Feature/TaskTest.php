<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que un usuario no autenticado no puede ver las tareas.
     */
    public function test_usuario_no_autenticado_es_redirigido_al_login(): void
    {
        $response = $this->get('/tasks');

        // Debe redirigir al formulario de login
        $response->assertRedirect('/login');
    }

    /**
     * Prueba que un usuario autenticado puede crear una tarea.
     */
    public function test_usuario_autenticado_puede_crear_una_tarea(): void
    {
        // 1. Creamos un usuario de prueba ficticio
        $user = User::factory()->create();

        // 2. Simulamos que el usuario inicia sesión y envía el formulario de crear tarea
        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Tarea de prueba automatizada',
            'description' => 'Descripción de la prueba',
        ]);

        // 3. Confirmamos que redirige a /tasks y la tarea existe en la base de datos asociada a ese user_id
        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'title' => 'Tarea de prueba automatizada',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Prueba que un usuario no puede ver las tareas de otro usuario.
     */
    public function test_usuario_no_puede_acceder_a_tareas_de_otro_usuario(): void
    {
        $usuario1 = User::factory()->create();
        $usuario2 = User::factory()->create();

        // El usuario 1 crea una tarea
        $tareaUsuario1 = Task::factory()->create([
            'user_id' => $usuario1->id,
            'title' => 'Tarea Secreta de Usuario 1',
        ]);

        // El usuario 2 intenta editar la tarea del usuario 1
        $response = $this->actingAs($usuario2)->get("/tasks/{$tareaUsuario1->id}/edit");

        // Confirmamos que el sistema responde con un error 403 (Acceso no autorizado)
        $response->assertStatus(403);
    }
}
