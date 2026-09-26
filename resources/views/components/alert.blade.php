@props(['type' => 'success', 'message'])

@php
    $styles = [
        'success' => 'border-lime-300/30 bg-lime-300/10 text-lime-200',
        'error' => 'border-red-400/30 bg-red-400/10 text-red-200',
    ][$type] ?? 'border-white/10 bg-zinc-900 text-zinc-300';
@endphp

<div role="status" class="mb-6 flex items-start gap-3 rounded-md border px-4 py-3 text-sm {{ $styles }}">
    <span class="font-mono text-xs font-semibold uppercase">{{ $type === 'success' ? 'Listo' : 'Aviso' }}</span>
    <span>{{ $message }}</span>
</div>