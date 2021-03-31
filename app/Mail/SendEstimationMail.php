<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEstimationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Cotización recibida';
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
        return $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.SendEstimation')
            ->attachFromStorage('/pdf/' . $this->pdf . '.pdf');
    }
}
