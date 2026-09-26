@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('content')
<section class="mx-auto max-w-xl">
    <a href="{{ route('tasks.index') }}" class="font-mono text-xs text-zinc-500 transition hover:text-lime-200">← Volver a tareas</a>
    <div class="mt-5 rounded-md border border-white/10 bg-zinc-900/80 p-5 sm:p-8">
        <p class="font-mono text-xs uppercase text-amber-300">Editar entrada <span class="text-zinc-600">/ #{{ $task->id }}</span></p>
        <h1 class="mt-2 text-2xl font-semibold text-white">Editar tarea</h1>
        <p class="mt-1 text-sm text-zinc-400">Actualiza los detalles o su estado.</p>

        <form action="{{ route('tasks.update', $task) }}" method="POST" class="mt-7 space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="mb-2 block text-sm font-medium text-zinc-200">Título <span class="text-lime-300">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required autofocus maxlength="255" aria-describedby="title-error" class="w-full rounded-md border border-white/10 bg-zinc-950 px-3 py-3 text-sm text-white focus:border-lime-300/60 focus:outline-none focus:ring-2 focus:ring-lime-300/20 @error('title') border-red-400 @enderror">
                @error('title')
                    <p id="title-error" class="mt-2 text-sm text-red-300">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-zinc-200">Descripción <span class="text-zinc-500">(opcional)</span></label>
                <textarea name="description" id="description" rows="4" class="w-full resize-y rounded-md border border-white/10 bg-zinc-950 px-3 py-3 text-sm text-white focus:border-lime-300/60 focus:outline-none focus:ring-2 focus:ring-lime-300/20">{{ old('description', $task->description) }}</textarea>
            </div>

            <label for="completed" class="flex cursor-pointer items-center gap-3 rounded-md border border-white/10 p-3 text-sm text-zinc-300">
                <input type="checkbox" name="completed" id="completed" value="1" @checked(old('completed', $task->completed)) class="size-4 accent-lime-300">
                Marcar como completada
            </label>

            <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('tasks.index') }}" class="rounded-md border border-white/15 px-4 py-3 text-center text-sm font-medium text-zinc-300 transition hover:border-white/30 hover:text-white">Cancelar</a>
                <button type="submit" class="rounded-md bg-lime-300 px-4 py-3 text-sm font-semibold text-zinc-950 transition hover:bg-lime-200">Guardar cambios</button>
            </div>
        </form>
    </div>
</section>
@endsection