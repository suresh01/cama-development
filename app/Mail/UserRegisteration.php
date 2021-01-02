<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteration extends Mailable
{
    use Queueable, SerializesModels;

    public $random_pass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($random_pass)
    {
         $this->random_pass = $random_pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user.register');
    }
}