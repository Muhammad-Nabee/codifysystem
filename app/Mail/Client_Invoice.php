<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Client_Invoice extends Mailable
{
    use Queueable, SerializesModels;
    public $client;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client)

    {   
        
       // dd($client);
        
        $this->client =$client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail From Codify')->view('admin.Client_invoice_mail');
    }
}
