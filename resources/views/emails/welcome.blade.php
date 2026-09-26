<x-mail::message>
# ¡Hola, {{ $user->name }}! 👋

Te damos la bienvenida a **Gestor de Tareas**. Estamos muy felices de tenerte con nosotros.

A partir de ahora podrás organizar tus pendientes, filtrar tareas finalizadas y mantener tu productividad al máximo de forma completamente privada.

<x-mail::button :url="route('login')">
Iniciar Sesión
</x-mail::button>

Gracias por unirte,<br>
El equipo de {{ config('app.name') }}
</x-mail::message>