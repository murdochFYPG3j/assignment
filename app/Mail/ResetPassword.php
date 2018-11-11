<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    protected $new_password;

    public function __construct($pw)
    {
        $this->new_password = $pw;
    }

    public function build()
    {
        return $this->html("
            You new password is: {$this->new_password}
        ");
    }
}
