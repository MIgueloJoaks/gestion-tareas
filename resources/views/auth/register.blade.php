@extends('layouts.app')

@section('title', 'Registro de Usuario')

@section('content')
<section class="mx-auto max-w-md rounded-md border border-white/10 bg-zinc-900/80 p-6 sm:p-8">
    <p class="font-mono text-xs uppercase text-lime-300">Neo / nuevo perfil</p>
    <h1 class="mt-3 text-2xl font-semibold text-white">Empieza por aquí.</h1>
    <p class="mt-1 text-sm text-zinc-400">Crea tu cuenta para organizar tus tareas.</p>

    <form action="{{ route('register.store') }}" method="POST" class="mt-7 space-y-4">
        @csrf
        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-zinc-200">Nombre completo</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name" aria-describedby="name-error" class="w-full rounded-md border border-white/10 bg-zinc-950 px-3 py-3 text-sm text-white focus:border-lime-300/60 focus:outline-none focus:ring-2 focus:ring-lime-300/20 @error('name') border-red-400 @enderror">
            @error('name')
                <p id="name-error" class="mt-2 text-sm text-red-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-zinc-200">Correo electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" aria-describedby="email-error" class="w-full rounded-md border border-white/10 bg-zinc-950 px-3 py-3 text-sm text-white focus:border-lime-300/60 focus:outline-none focus:ring-2 focus:ring-lime-300/20 @error('email') border-red-400 @enderror">
            @error('email')
                <p id="email-error" class="mt-2 text-sm text-red-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-zinc-200">Contraseña</label>
            <input type="password" name="password" id="password" required autocomplete="new-password" aria-describedby="password-error" class="w-full rounded-md border border-white/10 bg-zinc-950 px-3 py-3 text-sm text-white focus:border-lime-300/60 focus:outline-none focus:ring-2 focus:ring-lime-300/20 @error('password') border-red-400 @enderror">
            @error('password')
                <p id="password-error" class="mt-2 text-sm text-red-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-zinc-200">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" class="w-full rounded-md border border-white/10 bg-zinc-950 px-3 py-3 text-sm text-white focus:border-lime-300/60 focus:outline-none focus:ring-2 focus:ring-lime-300/20">
        </div>

        <button type="submit" class="w-full rounded-md bg-lime-300 px-4 py-3 text-sm font-semibold text-zinc-950 transition hover:bg-lime-200">Crear cuenta</button>
    </form>

    <p class="mt-6 border-t border-white/10 pt-5 text-sm text-zinc-400">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="font-medium text-lime-300 hover:text-lime-200">Inicia sesión</a>
    </p>
</section>
@endsection