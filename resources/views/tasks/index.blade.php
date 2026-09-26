@extends('layouts.app')

@section('title', 'Panel de Control // Tareas')

@section('content')
<div class="mx-auto max-w-5xl space-y-8">
    <section class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
        <div>
            <p class="mb-3 font-mono text-xs uppercase text-lime-300">Tu espacio de trabajo <span class="text-zinc-600">/ 01</span></p>
            <h1 class="text-3xl font-semibold tracking-tight text-white sm:text-4xl">Tareas<span class="text-lime-300">.</span></h1>
            <p class="mt-2 text-sm text-zinc-400">Una cosa a la vez. Lo demás puede esperar.</p>
        </div>

        <a href="{{ route('tasks.create') }}" class="inline-flex items-center justify-center gap-2 rounded-md bg-lime-300 px-4 py-3 text-sm font-semibold text-zinc-950 transition hover:bg-lime-200">
            <span class="text-lg leading-none">+</span> Nueva tarea
        </a>
    </section>

    <section class="space-y-4">
        <form action="{{ route('tasks.index') }}" method="GET" class="flex flex-col gap-3 sm:flex-row">
            <label for="search" class="sr-only">Buscar tareas</label>
            <input id="search" type="search" name="search" value="{{ request('search') }}" placeholder="Buscar una tarea..." class="min-w-0 flex-1 rounded-md border border-white/10 bg-zinc-900/80 px-4 py-3 text-sm text-white placeholder:text-zinc-500 focus:border-lime-300/60 focus:outline-none focus:ring-2 focus:ring-lime-300/20">
            @if (request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <button type="submit" class="rounded-md border border-white/15 px-5 py-3 text-sm font-medium text-zinc-200 transition hover:border-lime-300/50 hover:text-lime-200">Buscar</button>
        </form>

        <nav aria-label="Filtrar tareas" class="flex flex-wrap gap-2 text-sm">
            <a href="{{ route('tasks.index', ['search' => request('search')]) }}" @if (!request('filter')) aria-current="page" @endif class="rounded-md px-3 py-2 transition {{ !request('filter') ? 'bg-white/10 text-white' : 'text-zinc-400 hover:bg-white/5 hover:text-white' }}">Todas</a>
            <a href="{{ route('tasks.index', ['filter' => 'pending', 'search' => request('search')]) }}" @if (request('filter') === 'pending') aria-current="page" @endif class="rounded-md px-3 py-2 transition {{ request('filter') === 'pending' ? 'bg-amber-300/10 text-amber-200' : 'text-zinc-400 hover:bg-white/5 hover:text-white' }}">Pendientes</a>
            <a href="{{ route('tasks.index', ['filter' => 'completed', 'search' => request('search')]) }}" @if (request('filter') === 'completed') aria-current="page" @endif class="rounded-md px-3 py-2 transition {{ request('filter') === 'completed' ? 'bg-lime-300/10 text-lime-200' : 'text-zinc-400 hover:bg-white/5 hover:text-white' }}">Completadas</a>
        </nav>
    </section>

    <section aria-label="Lista de tareas" class="space-y-3">
        <p class="font-mono text-xs text-zinc-500">{{ $tasks->total() }} {{ $tasks->total() === 1 ? 'tarea' : 'tareas' }}</p>
        @forelse ($tasks as $task)
            <article class="flex flex-col gap-4 rounded-md border border-white/10 bg-zinc-900/70 p-4 transition hover:border-white/20 sm:flex-row sm:items-center sm:justify-between sm:p-5">
                <div class="flex min-w-0 items-start gap-4">
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="pt-0.5">
                        @csrf
                        @method('PATCH')
                        <button type="submit" aria-label="{{ $task->completed ? 'Marcar como pendiente' : 'Marcar como completada' }}" class="grid size-6 shrink-0 place-items-center rounded border transition {{ $task->completed ? 'border-lime-300 bg-lime-300 text-zinc-950' : 'border-zinc-600 text-transparent hover:border-lime-300' }}">
                            <span aria-hidden="true">✓</span>
                        </button>
                    </form>

                    <div class="min-w-0">
                        <h2 class="break-words text-sm font-medium {{ $task->completed ? 'text-zinc-500 line-through' : 'text-white' }}">{{ $task->title }}</h2>
                        @if ($task->description)
                            <p class="mt-1 whitespace-pre-line break-words text-sm leading-relaxed text-zinc-400">{{ $task->description }}</p>
                        @endif
                        <p class="mt-3 font-mono text-[11px] text-zinc-600">#{{ $task->id }} <span class="px-1">/</span> {{ $task->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-4 border-t border-white/10 pt-3 sm:justify-end sm:border-0 sm:pt-0">
                    <span class="font-mono text-[11px] uppercase {{ $task->completed ? 'text-lime-300' : 'text-amber-300' }}">{{ $task->completed ? 'Completada' : 'Pendiente' }}</span>
                    <div class="flex items-center gap-4 text-xs font-medium">
                        <a href="{{ route('tasks.edit', $task) }}" class="text-zinc-400 transition hover:text-white">Editar</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('¿Eliminar esta tarea?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-zinc-500 transition hover:text-red-300">Eliminar</button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-md border border-dashed border-white/15 px-6 py-12 text-center">
                <p class="text-sm font-medium text-zinc-300">No hay tareas que mostrar.</p>
                <p class="mt-1 text-sm text-zinc-500">Prueba con otro filtro o crea una tarea nueva.</p>
            </div>
        @endforelse
    </section>

    <div class="pt-2">
        {{ $tasks->links() }}
    </div>
</div>
@endsection