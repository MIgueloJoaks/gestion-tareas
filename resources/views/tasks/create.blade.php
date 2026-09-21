@extends('layouts.app')

@section('title', 'Crear Nueva Tarea')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Crear Nueva Tarea</h2>

    <form action="{{ route('tasks.store') }}" method="POST">
        <!-- Directiva de seguridad obligatoria en formularios POST en Laravel -->
        @csrf

        <!-- Campo Título -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Título de la tarea *</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('title') border-red-500 @enderror"
                   placeholder="Ej. Estudiar componentes de Blade">
            
            <!-- Mostrar mensaje de error si la validación falla -->
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo Descripción -->
        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-medium mb-2">Descripción (Opcional)</label>
            <textarea name="description" id="description" rows="4" 
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                      placeholder="Detalles adicionales sobre la tarea...">{{ old('description') }}</textarea>
        </div>

        <!-- Botones de Acción -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('tasks.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg transition">
                Cancelar
            </a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
                Guardar Tarea
            </button>
        </div>
    </form>
</div>
@endsection