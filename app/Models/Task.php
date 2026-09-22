<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    /**
     * Relación: La tarea pertenece a un usuario específico.
     */
    public function taskOwner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}