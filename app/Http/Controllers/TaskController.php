<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Muestra la lista de todas las tareas.
     */
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Muestra el formulario para crear una nueva tarea.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Guarda una nueva tarea en la base de datos PostgreSQL.
     */
    public function store(Request $request)
    {
        // 1. Validamos los datos recibidos del formulario
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ], [
            'title.required' => 'El título de la tarea es obligatorio.',
            'title.max' => 'El título no puede superar los 255 caracteres.',
        ]);

        // 2. Creamos el registro en la base de datos usando asignación masiva
        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => false,
        ]);

        // 3. Redirigimos a la lista de tareas con un mensaje de éxito
        return redirect()->route('tasks.index')->with('success', '¡Tarea creada con éxito!');
    }

    /**
     * Muestra el formulario para editar una tarea existente.
     */
    public function edit(Task $task)
    {
        // Usamos Route Model Binding: Laravel busca automáticamente la tarea por su ID
        return view('tasks.edit', compact('task'));
    }

    /**
     * Actualiza la tarea en la base de datos.
     */
    public function update(Request $request, Task $task)
    {
        // Validamos la información antes de actualizar
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        // Actualizamos los datos de la tarea
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => $request->has('completed'), // Devuelve true si el checkbox fue marcado
        ]);

        return redirect()->route('tasks.index')->with('success', '¡Tarea actualizada correctamente!');
    }

    /**
     * Elimina una tarea de la base de datos.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', '¡Tarea eliminada exitosamente!');
    }
}
