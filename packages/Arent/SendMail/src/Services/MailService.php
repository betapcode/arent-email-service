<?php

namespace Arent\SendMail\Services;

use Arent\SendMail\Jobs\ArentJobSendEmail;

class MailService
{
    public function sendEmail($emails, $details)
    {
        foreach ($emails as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $details['to'] = $email ?? 'betapcode@gmail.com';
                dispatch(new ArentJobSendEmail($details));
            }
        }
    }
}
