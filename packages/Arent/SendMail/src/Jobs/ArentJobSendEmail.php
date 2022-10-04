<?php

namespace Arent\SendMail\Jobs;

use Arent\SendMail\Mail\SendMailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class ArentJobSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail_to = $this->event['to'] ?? 'betapcode@gmail.com';
        $arrMail = new SendMailService($this->event);
        try {
            Mail::mailer('smtp')->to($mail_to)->send($arrMail);
        } catch (\Exception $e) {
            // there was an error sending email, try sending with another smtp service
            Mail::mailer('smtp2')->to($mail_to)->send($arrMail);
        }
    }
}
