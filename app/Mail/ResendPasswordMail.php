<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResendPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tenant;
    public $password;

    public function __construct($tenant, $password)
    {
        $this->tenant = $tenant;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your Account is Activated')
                    ->view('emails.resend_password')
                    ->with([
                        'name' => $this->tenant->name,
                        'password' => $this->password,
                    ]);
    }
} 