@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Mis Tareas</h2>
        <a href="{{ route('tasks.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
            + Nueva Tarea
        </a>
    </div>

    <!-- Lista de Tareas -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @forelse ($tasks as $task)
            <div class="p-4 border-b border-gray-200 flex justify-between items-center hover:bg-gray-50">
                <div class="pr-4">
                    <h3 class="text-lg font-semibold {{ $task->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                        {{ $task->title }}
                    </h3>
                    @if ($task->description)
                        <p class="text-gray-600 text-sm mt-1">{{ $task->description }}</p>
                    @endif
                </div>

                <!-- Botones y Estado -->
                <div class="flex items-center space-x-3">
                    <span class="px-3 py-1 text-xs rounded-full {{ $task->completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $task->completed ? 'Completada' : 'Pendiente' }}
                    </span>

                    <!-- Enlace de Editar -->
                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        Editar
                    </a>

                    <!-- Formulario de Eliminación -->
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-gray-500">
                <p class="text-lg">No hay tareas registradas aún.</p>
                <p class="text-sm mt-1">¡Crea tu primera tarea para comenzar!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection