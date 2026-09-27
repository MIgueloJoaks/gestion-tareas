<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Retorna la lista de tareas del usuario autenticado en JSON.
     */
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $tasks
        ], 200);
    }

    /**
     * Crea una nueva tarea asociada al usuario del Token.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = $request->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tarea creada correctamente mediante API.',
            'data' => $task
        ], 201); // Código 201: Creado con éxito
    }

    /**
     * Muestra el detalle de una tarea específica en JSON.
     */
    public function show(Request $request, Task $task)
    {
        $this->authorizeUserTask($request, $task);

        return response()->json([
            'status' => 'success',
            'data' => $task
        ], 200);
    }

    /**
     * Actualiza una tarea existente.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeUserTask($request, $task);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $task->update($request->only(['title', 'description', 'completed']));

        return response()->json([
            'status' => 'success',
            'message' => 'Tarea actualizada vía API.',
            'data' => $task
        ], 200);
    }

    /**
     * Elimina una tarea de la base de datos.
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorizeUserTask($request, $task);

        $task->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tarea eliminada vía API.'
        ], 200);
    }

    /**
     * Verifica que la tarea pertenezca al usuario del Token.
     */
    private function authorizeUserTask(Request $request, Task $task)
    {
        if ($task->user_id !== $request->user()->id) {
            abort(response()->json(['message' => 'No autorizado para acceder a este recurso.'], 403));
        }
    }
}