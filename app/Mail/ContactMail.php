<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contenu;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Fiche depense numero ' . $this->contenu['fiche_depense_id'])
                    ->view('mail.contact-mail');
    }
}
