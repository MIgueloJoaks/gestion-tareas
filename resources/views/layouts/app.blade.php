<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0b1110">
    <title>@yield('title', 'NEO TASKS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col font-sans text-zinc-200 antialiased selection:bg-lime-300 selection:text-zinc-950">
    <header class="sticky top-0 z-10 border-b border-white/10 bg-zinc-950/90 backdrop-blur">
        <div class="mx-auto flex w-full max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <a href="{{ route('tasks.index') }}" class="flex items-center gap-3" aria-label="Neo Tasks, ir al panel">
                <span class="grid size-9 place-items-center rounded-md bg-lime-300 font-mono text-sm font-bold text-zinc-950">N</span>
                <span class="font-mono text-sm font-semibold tracking-wide text-white">NEO<span class="text-lime-300">/</span>TASKS</span>
            </a>

            <div class="flex items-center gap-4 text-sm">
                @auth
                    <span class="hidden text-zinc-400 sm:inline">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-md border border-white/15 px-3 py-2 text-xs font-medium text-zinc-300 transition hover:border-red-400/60 hover:text-red-300">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-zinc-400 transition hover:text-white">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-lime-300 px-3 py-2 text-xs font-semibold text-zinc-950 transition hover:bg-lime-200">Crear cuenta</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-8 sm:px-6 sm:py-12">
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-white/10 py-4 text-center font-mono text-[11px] text-zinc-600">
        <p>NEO TASKS <span class="text-zinc-700">/</span> LARAVEL {{ app()->version() }}</p>
    </footer>
</body>
</html>