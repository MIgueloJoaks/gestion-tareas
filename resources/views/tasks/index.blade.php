@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <!-- Encabezado y Botón Crear -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Mis Tareas</h2>
        <a href="{{ route('tasks.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
            + Nueva Tarea
        </a>
    </div>

    <!-- Barra de Búsqueda y Filtros -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <form action="{{ route('tasks.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
            
            <!-- Buscador -->
            <div class="w-full md:w-1/2">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Buscar por título..." 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Botones de Filtro -->
            <div class="flex items-center space-x-2 w-full md:w-auto justify-end">
                <a href="{{ route('tasks.index') }}" 
                   class="px-3 py-2 text-sm rounded-lg border {{ !request('filter') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }}">
                    Todas
                </a>
                <a href="{{ route('tasks.index', ['filter' => 'pending', 'search' => request('search')]) }}" 
                   class="px-3 py-2 text-sm rounded-lg border {{ request('filter') === 'pending' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }}">
                    Pendientes
                </a>
                <a href="{{ route('tasks.index', ['filter' => 'completed', 'search' => request('search')]) }}" 
                   class="px-3 py-2 text-sm rounded-lg border {{ request('filter') === 'completed' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700' }}">
                    Completadas
                </a>
                
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <!-- Lista de Tareas -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @forelse ($tasks as $task)
            <div class="p-4 border-b border-gray-200 flex justify-between items-center hover:bg-gray-50">
                <div class="flex items-center space-x-3">
                    
                    <!-- Botón de Acción Rápida (Toggle Checkbox) -->
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" title="Cambiar estado" 
                                class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition {{ $task->completed ? 'bg-green-500 border-green-500 text-white' : 'border-gray-400 hover:border-green-500' }}">
                            @if ($task->completed)
                                ✓
                            @endif
                        </button>
                    </form>

                    <!-- Título y Descripción -->
                    <div>
                        <h3 class="text-lg font-semibold {{ $task->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                            {{ $task->title }}
                        </h3>
                        @if ($task->description)
                            <p class="text-gray-600 text-sm mt-1">{{ $task->description }}</p>
                        @endif
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="flex items-center space-x-3">
                    <span class="px-3 py-1 text-xs rounded-full {{ $task->completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $task->completed ? 'Completada' : 'Pendiente' }}
                    </span>

                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        Editar
                    </a>

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
                <p class="text-lg">No se encontraron tareas con los filtros seleccionados.</p>
            </div>
        @endforelse
    </div>

    <!-- Enlaces de Paginación -->
    <div class="mt-6 [&_svg]:w-4 [&_svg]:h-4">
        {{ $tasks->links() }}
    </div>

</div>
@endsection