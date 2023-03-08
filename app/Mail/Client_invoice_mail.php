<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Emp_notice_mail extends Mailable
{
    use Queueable, SerializesModels;
    public $Client_invoice_mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Client_invoice_mail)

    {   
        
        
        $this->Client_invoice_mail =$Client_invoice_mail;
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
