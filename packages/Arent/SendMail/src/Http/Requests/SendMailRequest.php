<?php

namespace Arent\SendMail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'subject' => 'required|string|min:3|max:250',
            'emails' => 'required',
            'content' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'subject.min' => 'Subject must be at least 3 characters.',
            'subject.max' => 'Subject must be at least 200 characters.',
            'subject.required' => 'Subject is required',
            'emails.required' => 'Emails is required',
            'content.required' => 'Content is required',
        ];
    }
}
