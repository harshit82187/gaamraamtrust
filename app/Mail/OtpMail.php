<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable implements ShouldQueue // Ensure it implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $otp;
    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($otp, $email)
    {
        $this->otp = $otp;
        $this->email = $email;

    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Email Verification OTP')
                    ->view('mail-template.student.otp')
                    ->with([
                        'otp' => $this->otp,
                        'email' => $this->email,
                    ]);
    }
}
