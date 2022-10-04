<?php

namespace Arent\SendMail\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Arent\SendMail\Http\Requests\SendMailRequest;
use Arent\SendMail\Services\MailService;
use Arent\SendMail\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class SendMailApiController extends Controller
{
    use ApiResponseTrait;

    protected $mailService;

    /**
     * @param MailService $mailService
     */
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * @param SendMailRequest $request
     * @return JsonResponse
     */
    public function sendMailProcess(SendMailRequest $request): JsonResponse
    {
        $emails = $request->input('emails', null);
        $subject = $request->input('subject', null);
        $content = $request->input('content', null);

        $emails = explode(', ', $emails);
        $emails = array_unique($emails);

        $details['content'] = $content;
        $details['subject'] = $subject;

        $this->mailService->sendEmail($emails, $details);

        return $this->apiResponse([
            'success' => true,
            'message' => $request->input('subject')
        ]);
    }
}
