<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MensajeRegistro extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuario)
    {
        // obtengo el usuario que se esta logueando
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registro');
    }
}
