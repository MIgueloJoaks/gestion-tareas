@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Iniciar Sesión</h2>

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Contraseña</label>
            <input type="password" name="password" required 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
            Ingresar
        </button>

        <p class="text-center text-sm text-gray-600 mt-4">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Regístrate gratis</a>
        </p>
    </form>
</div>
@endsection