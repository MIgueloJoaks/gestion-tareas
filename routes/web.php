<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Genera automáticamente las rutas para index, create, store, edit, update y destroy
Route::resource('tasks', TaskController::class);

// Redirige la raíz '/' a la lista de tareas
Route::redirect('/', '/tasks');
