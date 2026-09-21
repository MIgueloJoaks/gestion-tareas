@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Tarea</h2>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        <!-- Los navegadores solo soportan GET y POST. Usamos @method('PUT') para simular PUT -->
        @method('PUT')

        <!-- Campo Título -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Título de la tarea *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Descripción -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Descripción</label>
            <textarea name="description" id="description" rows="4" 
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $task->description) }}</textarea>
        </div>

        <!-- Checkbox Estado Completado -->
        <div class="mb-6 flex items-center">
            <input type="checkbox" name="completed" id="completed" value="1" 
                   {{ $task->completed ? 'checked' : '' }}
                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
            <label for="completed" class="ml-2 block text-gray-700 font-medium">
                Marcar como completada
            </label>
        </div>

        <!-- Botones de Acción -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('tasks.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
                Cancelar
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
                Actualizar Tarea
            </button>
        </div>
    </form>
</div>
@endsection