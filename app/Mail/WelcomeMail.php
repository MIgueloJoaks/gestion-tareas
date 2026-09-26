<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    // Propiedad pública accesible directamente dentro de la plantilla Blade
    public User $user;

    /**
     * Crea una nueva instancia del mensaje inyectando el usuario.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Define el asunto del correo electrónico.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Bienvenido a Gestor de Tareas!',
        );
    }

    /**
     * Asocia la plantilla visual Blade del correo.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.welcome',
        );
    }
}