<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Salary_mail extends Mailable
{
    use Queueable, SerializesModels;
    public $Salary_mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Salary_mail)

    {   
        // dd($Salary_mail);
        
        $this->Salary_mail =$Salary_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail From Codify')->view('admin.Salary_mail');
    }
}
