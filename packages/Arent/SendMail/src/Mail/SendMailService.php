<?php

namespace Arent\SendMail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailService extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = env('MAIL_FROM_ADDRESS', null);
        $subject = $this->data['subject'] ?? 'Subject default';
        $name = env('MAIL_FROM_NAME', '');

        return $this->view('arent_send_email::email-templates.email')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with($this->data);
    }
}
