<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Tareas')</title>
    <!-- Cargamos Tailwind CSS desde CDN para un estilo rápido y atractivo -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <!-- Encabezado de la aplicación -->
    <header class="bg-indigo-600 text-white shadow-md py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">
                <a href="{{ route('tasks.index') }}">Gestor de Tareas</a>
            </h1>
        </div>
    </header>

    <!-- Contenido Dinámico inyectado por las vistas hijas -->
    <main class="container mx-auto px-4 py-8 flex-grow">
    <!-- Mensaje de notificación flash -->
        @if (session('success'))
            <div class="max-w-4xl mx-auto mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow" role="alert">
                <p class="font-bold">¡Operación exitosa!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="bg-gray-800 text-gray-400 py-4 text-center text-sm">
        <p>Desarrollado con Laravel {{ app()->version() }} y Blade</p>
    </footer>

</body>
</html>