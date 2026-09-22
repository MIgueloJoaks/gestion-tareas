@props(['type' => 'success', 'message'])

@php
    $classes = [
        'success' => 'bg-green-100 border-green-500 text-green-700',
        'error'   => 'bg-red-100 border-red-500 text-red-700',
        'info'    => 'bg-blue-100 border-blue-500 text-blue-700',
    ][$type] ?? 'bg-gray-100 border-gray-500 text-gray-700';
@endphp

<div class="max-w-4xl mx-auto mb-6 border-l-4 p-4 rounded shadow {{ $classes }}" role="alert">
    <p class="font-bold">{{ ucfirst($type === 'success' ? 'Éxito' : $type) }}</p>
    <p>{{ $message }}</p>
</div>