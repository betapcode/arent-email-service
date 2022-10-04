<?php

namespace Arent\SendMail\Http\Controllers;

use App\Http\Controllers\Controller;
use Arent\SendMail\Http\Requests\SendMailRequest;
use Arent\SendMail\Services\MailService;
use Arent\SendMail\Services\SendMailService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SendEmailController extends Controller
{
    protected $mailService;

    /**
     * @param MailService $mailService
     */
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * Return view.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('arent_send_email::sendmail.index');
    }

    /**
     * @param SendMailRequest $request
     * @return RedirectResponse
     */
    public function sendMailProcess(SendMailRequest $request): RedirectResponse
    {
        $emails = $request->input('emails', null);
        $subject = $request->input('subject', null);
        $content = $request->input('content', null);

        $emails = explode(', ', $emails);
        $emails = array_unique($emails);

        $details['content'] = $content;
        $details['subject'] = $subject;

        $this->mailService->sendEmail($emails, $details);

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
