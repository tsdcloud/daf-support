<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateMaterterialReleaseMail extends Mailable
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
        // dd($contenu);
        $this->contenu = $contenu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bon de sortie matériel numéro ' . $this->contenu['material_realise_form_id'])
        ->view('mail.create_material_release_form_mail');
    }
}
