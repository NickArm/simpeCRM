<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Ensure this interface is used if you're planning to queue your emails
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable implements ShouldQueue // Implement ShouldQueue if you intend to queue the email
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        // Your constructor can pass in any data you want to use within the email, like user information or a message body.
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // This method returns the mailable object itself, specifying the view and subject
        return $this->subject('Sample Email') // You could also set the subject here dynamically
            ->view('emails.sendMessage'); // Make sure 'emails.sendMessage' view exists in resources/views/emails/sendMessage.blade.php
    }
}
