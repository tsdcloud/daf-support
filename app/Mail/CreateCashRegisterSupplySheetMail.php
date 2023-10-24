<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateCashRegisterSupplySheetMail extends Mailable
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
        return $this->subject('Fiche approvisionnement caisse numéro ' . $this->contenu['fiche_approv_caisse_id'])
        ->view('mail.create_cash_register_supply_sheet_mail');
    }
}
