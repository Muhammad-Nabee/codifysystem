<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Empolyee_Mail extends Mailable
{
    use Queueable, SerializesModels;
    public $empolyee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($empolyee)

    {   
        
        $this->empolyee =$empolyee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail From Codify')->view('admin.Empolyee_Mail');
    }
}
