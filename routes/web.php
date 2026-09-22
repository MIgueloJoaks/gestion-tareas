<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Ruta personalizada para cambiar el estado de la tarea rápidamente
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');

// Rutas de recurso estándar para el CRUD
Route::resource('tasks', TaskController::class);

// Redirige la raíz '/' a la lista de tareas
Route::redirect('/', '/tasks');
