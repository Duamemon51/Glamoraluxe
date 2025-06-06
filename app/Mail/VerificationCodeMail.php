<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationCode;

    // Constructor to pass the verification code
    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    // Build the email with the verification code
    public function build()
    {
        return $this->view('emails.verification_code')
                    ->with(['verificationCode' => $this->verificationCode]);
    }
}
