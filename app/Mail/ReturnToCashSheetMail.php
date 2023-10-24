<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnToCashSheetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData =  $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Validation de la fiche de retour caisse')->view('mail.validation_return_to_cash_sheet_mail');
    }
}
