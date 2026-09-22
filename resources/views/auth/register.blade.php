@extends('layouts.app')

@section('title', 'Registro de Usuario')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Crear una Cuenta</h2>

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Nombre completo</label>
            <input type="text" name="name" value="{{ old('name') }}" required 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
            <input type="email" name="email" value="{{ old('email') }}" required 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Contraseña</label>
            <input type="password" name="password" required 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror">
            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" required 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
            Registrarse
        </button>

        <p class="text-center text-sm text-gray-600 mt-4">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Inicia sesión aquí</a>
        </p>
    </form>
</div>
@endsection