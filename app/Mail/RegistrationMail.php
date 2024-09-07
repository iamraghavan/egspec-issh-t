<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $pdfPath;
    public $eventTitle; // Define the property

    public function __construct($data, $pdfPath, $eventTitle)
    {
        $this->data = $data;
        $this->pdfPath = $pdfPath;
        $this->eventTitle = $eventTitle; // Initialize the eventTitle property
    }

    public function build()
    {
        return $this->view('pages.mail.registration-mail') // Ensure this path is correct
            ->with($this->data) // Pass the data array to the view
            ->attach($this->pdfPath, [
                'as' => 'e-ticket.pdf',
                'mime' => 'application/pdf',
            ])
            ->subject("Registration Confirmation for {$this->eventTitle}"); // Set the subject
    }
}
