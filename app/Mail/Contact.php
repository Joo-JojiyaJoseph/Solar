<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $attachment;
    public $message;
    public $subject;

    public function __construct($attachment,$message, $subject)
    {
        $this->message = $message;
        $this->subject = $subject;
        $this->attachment = $attachment;
    }

    public function build()
    {
        return $this->subject($this->subject)
        ->markdown('emails.contact', ['message' => $this->message])->attach($this->attachment);
    }

}
