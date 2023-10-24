<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateRecipeSheetMail extends Mailable
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
        return $this->subject('Fiche de recette numéro ' . $this->contenu['recipe_sheet']->id)
        ->view('mail.creation_fiche_recette_mail');
    }
}
