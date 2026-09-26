@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<section class="mx-auto max-w-md rounded-md border border-white/10 bg-zinc-900/80 p-6 sm:p-8">
    <p class="font-mono text-xs uppercase text-lime-300">Neo / acceso</p>
    <h1 class="mt-3 text-2xl font-semibold text-white">Qué bueno verte.</h1>
    <p class="mt-1 text-sm text-zinc-400">Inicia sesión para volver a tus tareas.</p>

    <form action="{{ route('login.store') }}" method="POST" class="mt-7 space-y-5">
        @csrf
        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-zinc-200">Correo electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="email" aria-describedby="email-error" class="w-full rounded-md border border-white/10 bg-zinc-950 px-3 py-3 text-sm text-white focus:border-lime-300/60 focus:outline-none focus:ring-2 focus:ring-lime-300/20 @error('email') border-red-400 @enderror">
            @error('email')
                <p id="email-error" class="mt-2 text-sm text-red-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-zinc-200">Contraseña</label>
            <input type="password" name="password" id="password" required autocomplete="current-password" class="w-full rounded-md border border-white/10 bg-zinc-950 px-3 py-3 text-sm text-white focus:border-lime-300/60 focus:outline-none focus:ring-2 focus:ring-lime-300/20">
        </div>

        <button type="submit" class="w-full rounded-md bg-lime-300 px-4 py-3 text-sm font-semibold text-zinc-950 transition hover:bg-lime-200">Iniciar sesión</button>
    </form>

    <p class="mt-6 border-t border-white/10 pt-5 text-sm text-zinc-400">
        ¿Primera vez aquí? <a href="{{ route('register') }}" class="font-medium text-lime-300 hover:text-lime-200">Crea una cuenta</a>
    </p>
</section>
@endsection