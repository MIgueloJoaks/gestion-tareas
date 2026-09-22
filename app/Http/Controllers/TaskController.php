<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user) {
            abort(401, 'No autenticado.');
        }

        // Consultamos únicamente las tareas del usuario con sesión activa
        $query = $user->tasks();

        if ($request->filled('search')) {
            $query->where('title', 'ILIKE', '%' . $request->input('search') . '%');
        }

        if ($request->filled('filter')) {
            if ($request->input('filter') === 'pending') {
                $query->where('completed', false);
            } elseif ($request->input('filter') === 'completed') {
                $query->where('completed', true);
            }
        }

        $tasks = $query->latest()->paginate(5)->withQueryString();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! $user) {
            abort(401, 'No autenticado.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        // Creamos la tarea asignándola automáticamente al usuario autenticado
        $user->tasks()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', '¡Tarea creada con éxito!');
    }

    public function edit(Task $task)
    {
        // Seguridad: Verificar que la tarea pertenece al usuario actual
        $this->authorizeUserTask($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeUserTask($task);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'completed' => $request->boolean('completed'),
        ]);

        return redirect()->route('tasks.index')->with('success', '¡Tarea actualizada correctamente!');
    }

    public function destroy(Task $task)
    {
        $this->authorizeUserTask($task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', '¡Tarea eliminada exitosamente!');
    }

    public function toggle(Task $task)
    {
        $this->authorizeUserTask($task);
        $task->update([
            'completed' => !$task->is_completed,
        ]);

        return back()->with('success', 'Estado de la tarea actualizado.');
    }

    /**
     * Valida si la tarea pertenece al usuario con sesión activa.
     */
    private function authorizeUserTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Acceso no autorizado.');
        }
    }
}